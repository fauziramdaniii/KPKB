<?php
namespace Member\Controller;

use Cake\Database\Expression\QueryExpression;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Member\Controller\AppController;

/**
 * Banks Controller
 *
 * @property \AdminPanel\Model\Table\EventsTable $Events
 * @method \Member\Model\Entity\Bank[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Events');
    }

    public function attendance()
    {
        $this->disableAutoRender();
        $this->getRequest()->allowMethod('post');
        $customer_id = $this->Auth->user('id');
        $confirm = $this->getRequest()->getData('confirm');
        $event_id = $this->getRequest()->getData('event_id');

        $response = [
            'status' => 'ERROR',
            'message' => __('Failed to update attendance')
        ];

        /**
         * @var \AdminPanel\Model\Entity\Event $eventEntity
         */
        $eventEntity = $this->Events->find()
            ->where([
                'Events.id' => $event_id
            ])
            ->first();

        if ($eventEntity) {

            //check is past
            if ($eventEntity->start->timestamp < time() && $eventEntity->end->timestamp < time()) {
                $response = [
                    'status' => 'ERROR',
                    'message' => __('Failed to update attendance')
                ];
            } else {

                //check attendance
                $attendanceEntity = $this->Events->EventAttendances->find()
                    ->where([
                        'event_id' => $eventEntity->id,
                        'customer_id' => $customer_id
                    ])
                    ->first();

                if ($attendanceEntity) {
                    $this->Events->EventAttendances->patchEntity($attendanceEntity, [
                        'confirm' => $confirm
                    ]);
                } else {
                    $attendanceEntity = $this->Events->EventAttendances->newEntity([
                        'event_id' => $event_id,
                        'customer_id' => $customer_id,
                        'confirm' => $confirm
                    ]);
                }


                if ($this->Events->EventAttendances->save($attendanceEntity)) {
                    $response = [
                        'status' => 'OK',
                        'message' => __('Success update attendance')
                    ];
                }
            }
        }

        return $this->response->withType('application/json')
            ->withStringBody(json_encode($response));

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $customer_id = $this->Auth->user('id');

        if ($this->request->is(['post', 'ajax'])) {
            $this->viewBuilder()->setLayout('ajax');

            FrozenTime::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss+07:00');  // For any immutable DateTime
            $events = $this->Events->find()
                ->contain([
                    'EventCategories'
                ]);

            $start = $this->getRequest()->getData('start');
            $end = $this->getRequest()->getData('end');

            $events->where(function(\Cake\Database\Expression\QueryExpression $exp) use($start, $end) {
                $start = Time::parse($start)->format('Y-m-d H:i:s');
                $end = Time::parse($end)->format('Y-m-d H:i:s');
                /*return $exp->gte('start', $start)
                    ->lte('end', $end);*/
                return $exp->or(function(QueryExpression $exp) use ($start, $end) {
                    return $exp->between('start', $start, $end)
                        ->between('end', $start, $end);
                });
            });

            if ($search = $this->getRequest()->getData('search')) {
                $events->where(['OR' => [
                    'Events.title LIKE' => '%' . $search .'%',
                    'Events.description LIKE' => '%' . $search .'%',
                ]]);
            }

            $events = $events
                ->map(function(\AdminPanel\Model\Entity\Event $row) use ($customer_id) {
                    if ($row->start instanceof \Cake\I18n\FrozenTime) {
                        $row->start->setTimezone(new \DateTimeZone('Asia/Jakarta'));
                    }

                    $row->attendances = [];

                    /**
                     * @var \AdminPanel\Model\Entity\EventAttendance $attendaceEntity
                     */
                    $attendaceEntity = $this->Events->EventAttendances->find()
                        ->where([
                            'event_id' => $row->id,
                            'customer_id' => $customer_id
                        ])
                        ->first();

                    if ($attendaceEntity) {
                        $row->attendances = $attendaceEntity;
                        $classname = '';
                        switch($attendaceEntity->confirm) {
                            case '1':
                                $classname = 'fc-event-success';
                                break;
                            case '2':
                                $classname = 'fc-event-primary';
                                break;
                            case '3':
                                $classname = 'fc-event-danger';
                                break;
                        }
                        $row->className = $classname;
                    }

                    //participants list

                    $participantTotal  = $this->Events->EventAttendances->find()
                        ->where([
                            'event_id' => $row->id,
                        ])
                        ->whereInList('confirm', [1, 2])
                        ->count();


                    $participantEntities = $this->Events->EventAttendances->find()
                        ->where([
                            'event_id' => $row->id,
                        ])
                        ->contain([
                            'Customers'
                        ])
                        ->whereInList('EventAttendances.confirm', [1, 2])
                        ->limit(5);

                    $row->participants = [
                        'total' => $participantTotal,
                        'data' => []
                    ];

                    if ($participantTotal > 0) {

                        $participants = [];
                        /**
                         * @var \AdminPanel\Model\Entity\EventAttendance[] $participantEntities
                         */
                        foreach($participantEntities as $participant) {
                            $participants[] = [
                                'name' => $participant->customer->first_name . ' ' . $participant->customer->last_name,
                                'avatar' => $participant->customer->avatar
                            ];
                        }


                        $row->participants = [
                            'total' => $participantTotal,
                            'data' => $participants
                        ];
                    }

                    $past = $row->start->timestamp < time() && $row->end->timestamp < time();
                    $row->past = $past;


                    return $row;
                });

            if (!$events) {
                $events = [];
            }

            return $this->response->withType('application/json')
                ->withStringBody(json_encode($events));
        }
    }


}

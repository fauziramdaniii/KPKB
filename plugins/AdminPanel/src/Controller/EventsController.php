<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use AdminPanel\Model\Table\ProvincesTable;
use Cake\Database\Expression\QueryExpression;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;

/**
 * Events Controller
 *
 * @property \AdminPanel\Model\Table\EventsTable $Events
 * @method \AdminPanel\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Events');
    }

    public function attendance(){

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Events->find('all')
                ->contain([
                    'EventCategories'
                ])
                ->select();

//            if ($query && is_array($query)) {
//                if (isset($query['generalSearch'])) {
//                    $search = $query['generalSearch'];
//                    unset($query['generalSearch']);
//                    /**
//                    custom field for general search
//                    ex : 'Users.email LIKE' => '%' . $search .'%'
//                     **/
//                    $data->where(['Topics.name LIKE' => '%' . $search .'%']);
//                }
//                $data->where($query);
//            }

            if (isset($sort['field']) && isset($sort['sort'])) {
                $data->order([$sort['field'] => $sort['sort']]);
            }

            if (isset($pagination['perpage']) && is_numeric($pagination['perpage'])) {
                $data->limit($pagination['perpage']);
            }
            if (isset($pagination['page']) && is_numeric($pagination['page'])) {
                $data->page($pagination['page']);
            }

            $total = $data->count();

            $result = [];
            $result['data'] = $data->toArray();


            $result['meta'] = array_merge((array) $pagination, (array) $sort);
            $result['meta']['total'] = $total;


            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }

    }

    public function categories()
    {
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Events->EventCategories->find()
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' =>[
                        'EventCategories.name LIKE' => '%' . $search .'%',
                    ]]);
                }

                $data->where($query);
            }



            if (isset($sort['field']) && isset($sort['sort'])) {
                $data->order([$sort['field'] => $sort['sort']]);
            }

            if (isset($pagination['perpage']) && is_numeric($pagination['perpage'])) {
                $data->limit($pagination['perpage']);
            }
            if (isset($pagination['page']) && is_numeric($pagination['page'])) {
                $data->page($pagination['page']);
            }

            $total = $data->count();

            $result = [];
            $result['data'] = $data->toArray();


            $result['meta'] = array_merge((array) $pagination, (array) $sort);
            $result['meta']['total'] = $total;


            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
    }

    public function addCategories()
    {
        $category = $this->Events->EventCategories->newEntity();
        if ($this->request->is('post')) {

            $user = $this->Events->EventCategories->patchEntity($category, $this->request->getData());
            if ($this->Events->EventCategories->save($user)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'categories']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }

        $this->set(compact('category'));
    }


    public function editCategories($id = null)
    {
        $category = $this->Events->EventCategories->get($id);
        //$this->viewBuilder()->setTemplate('add_categories');
        if ($this->request->is(['PUT'])) {
            $this->Events->EventCategories->patchEntity($category, $this->request->getData());
            if ($this->Events->EventCategories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'categories']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }


        $this->set(compact('category'));
    }

    public function deleteCategories($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Events->EventCategories->get($id);

        if ($this->Events->EventCategories->delete($user)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'categories']);
    }


    public function moveEvent()
    {
        $this->disableAutoRender();
        $this->getRequest()->allowMethod('post');
        $this->viewBuilder()->setLayout('ajax');
        $start = $this->getRequest()->getData('start');
        $end = $this->getRequest()->getData('end');
        $event_id = $this->getRequest()->getData('event_id');

        $response = [
            'status' => 'ERROR',
            'message' => 'Failed to move calendar'
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
            $eventEntity->start = Time::parse($start)->format('Y-m-d H:i:s');
            $eventEntity->end = Time::parse($end)->format('Y-m-d H:i:s');

            if ($this->Events->save($eventEntity)) {
                $response = [
                    'status' => 'OK',
                    'message' => __('Success move calendar or event')
                ];
            }
        }


        return $this->response->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function process()
    {
        $this->getRequest()->allowMethod('post');
        $this->disableAutoRender();

        $response = [
            'status' => 'ERROR'
        ];

        $status = $this->getRequest()->getData('status');
        $event_attendances_id = $this->getRequest()->getData('ids');

        if (is_array($event_attendances_id) && count($event_attendances_id) > 0) {

            $update = $this->Events->EventAttendances->query()
                ->update()
                ->set([
                    'present' => $status == 1 ? 1 : 0
                ])
                ->whereInList('id', $event_attendances_id)
                ->execute();

            if ($update) {
                $response = [
                    'status' => 'OK'
                ];
            }

        }

        return $this->response->withType('application/json')
            ->withStringBody(json_encode($response));


    }

    public function participants($event_id)
    {
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Events->EventAttendances->find()
                ->whereInList('confirm', [1, 2])
                ->select();
            $data->contain([
                'Customers',
                'Events'
            ]);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' =>[
                        'Customers.username LIKE' => '%' . $search .'%',
                        'Customers.email LIKE' => '%' . $search .'%',
                        'Customers.first_name LIKE' => '%' . $search .'%',
                        'Customers.last_name LIKE' => '%' . $search .'%',
                    ]]);
                }
                if (isset($query['is_active'])) {
                    $is_active = $query['is_active'];
                    //unset($query['card_status_id']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Customers.is_active' => $is_active]);
                }
                $data->where($query);
            }

            $data->where(['event_id' => $event_id]);

            if (isset($sort['field']) && isset($sort['sort'])) {
                $data->order([$sort['field'] => $sort['sort']]);
            }

            if (isset($pagination['perpage']) && is_numeric($pagination['perpage'])) {
                $data->limit($pagination['perpage']);
            }
            if (isset($pagination['page']) && is_numeric($pagination['page'])) {
                $data->page($pagination['page']);
            }

            $total = $data->count();

            $result = [];
            $result['data'] = $data->toArray();


            $result['meta'] = array_merge((array) $pagination, (array) $sort);
            $result['meta']['total'] = $total;


            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        /**
         * list of classname
         *  className: "fc-event-danger fc-event-solid-warning"
         * className: "fc-event-success"
         * className: "fc-event-primary"
         * className: "fc-event-light fc-event-solid-primary"
         * className: "fc-event-brand"
         * className: "fc-event-info",
         * className: "fc-event-solid-danger fc-event-light",
         * className: "fc-event-solid-info fc-event-light",
         */
        FrozenTime::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss+07:00');  // For any immutable DateTime

        if ($this->getRequest()->is(['post'])) {
            $this->viewBuilder()->setLayout('ajax');
            $events = $this->Events->find()
                ->contain([
                    'EventCategories'
                ]);

            $start = $this->getRequest()->getData('start');
            $end = $this->getRequest()->getData('end');

            $events->where(function(\Cake\Database\Expression\QueryExpression $exp) use($start, $end) {
                $start = Time::parse($start)->format('Y-m-d H:i:s');
                $end = Time::parse($end)->format('Y-m-d H:i:s');

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
                ->map(function(\AdminPanel\Model\Entity\Event $row) {
                    if ($row->start instanceof \Cake\I18n\FrozenTime) {
                        $row->start->setTimezone(new \DateTimeZone('Asia/Jakarta'));

                    }


                    $attendaceEntity = $this->Events->EventAttendances->find()
                        ->where([
                            'event_id' => $row->id,
                        ])
                        ->whereInList('confirm', [1, 2])
                        ->count();

                    $row->className = '';
                    if ($attendaceEntity > 0) {
                        $row->className = 'fc-event-success';
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

                    return $row;
                });

            return $this->response->withType('application/json')
                ->withStringBody(json_encode($events));

        }

        $event_categories = $this->Events->EventCategories->find('list');

        $this->set(compact('event_categories'));

    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => [],
        ]);

        $this->set('event', $event);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {

            $response = [
                'status' => 'ERROR',
                'message' => 'Failed to add event'
            ];

            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                //$this->Flash->success(__('The event has been saved.'));
                //return $this->redirect(['action' => 'index']);
                $response = [
                    'status' => 'OK',
                    'message' => 'The event has been saved'
                ];


            } else {
                $response = [
                    'status' => 'ERROR',
                    'message' => 'The event could not be saved. Please, try again.'
                ];
            }
            //$this->Flash->error(__('The event could not be saved. Please, try again.'));


            return $this->response->withType('application/json')
                ->withStringBody(json_encode($response));

        }
        //$this->set(compact('event'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $response = [
            'status' => 'ERROR',
            'message' => 'The event could not be saved. Please, try again.'
        ];

        $event = $this->Events->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {

                $response = [
                    'status' => 'OK',
                    'message' => 'The event has been saved.'
                ];

                //$this->Flash->success(__('The event has been saved.'));

                //return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The event could not be saved. Please, try again.'));
        }

        return $this->response->withType('application/json')
            ->withStringBody(json_encode($response));

        //$this->set(compact('event'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $response = [
            'status' => 'ERROR',
            'message' => 'The event could not be deleted. Please, try again.'
        ];

        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            //$this->Flash->success(__('The event has been deleted.'));

            $response = [
                'status' => 'OK',
                'message' => 'The event has been deleted.'
            ];


        } else {
            //$this->Flash->error(__('The event could not be deleted. Please, try again.'));
            $response = [
                'status' => 'ERROR',
                'message' => 'The event could not be deleted. Please, try again.'
            ];
        }

        return $this->response->withType('application/json')
            ->withStringBody(json_encode($response));

        //return $this->redirect(['action' => 'index']);
    }
}

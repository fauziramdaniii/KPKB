<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use AdminPanel\Model\Entity\TransactionType;
use Cake\Core\Configure;
use Cake\I18n\Time;

/**
 * Withdrawals Controller
 * @property \AdminPanel\Model\Table\CustomerActivationsTable $CustomerActivations
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \AdminPanel\Model\Table\GenerationsTable $Generations
 * @property \AdminPanel\Model\Table\TransactionsTable $Transactions
 * @property \AdminPanel\Model\Table\CustomerPeriodsTable $CustomerPeriods
 *
 */
class ActivationsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.CustomerActivations');
        $this->loadModel('AdminPanel.Customers');
        $this->loadModel('AdminPanel.Generations');
        $this->loadModel('AdminPanel.Transactions');
        $this->loadModel('AdminPanel.CustomerPeriods');

    }

    public function setRefferal()
    {
        $this->viewBuilder()->setLayout('ajax');

        $this->getRequest()->allowMethod('post');

        $result = [
            'result' => 'ok'
        ];


        if (($refferal_id = $this->getRequest()->getData('refferal_id')) && ($customer_id = $this->getRequest()->getData('customer_id'))) {
            /**
             * @var \AdminPanel\Model\Entity\Customer $customerEntity
             */
            $customerEntity = $this->Customers->find()
                ->where([
                    'id' => $customer_id
                ])
                ->first();

            if ($customerEntity) {
                $customerEntity->refferal_id = $refferal_id;
                $customerEntity->upline_id = $refferal_id;

                if (!$this->Customers->save($customerEntity)) {
                    $result = [
                        'result' => 'error'
                    ];
                }

            }
        }


        return $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
    }

    public function process(){

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $status = $this->request->getData('status');
            $ids = $this->request->getData('ids');

            switch ($status) {
                case '1': //success

                    foreach($ids as $vals) {
                        $confirm =  $this->CustomerActivations->get($vals, [
                            'contain' => [
                                'Customers'
                            ]
                        ]);

                        if($confirm->get('status') != 0){
                            $this->Flash->error(__('The confirmation has been success before, cannot do double process'));
                            continue;
                        }

                        $confirm->status = 1;
                        if ($this->CustomerActivations->save($confirm)) {
                            $confirm->customer->is_active = 1;
                            $confirm->customer->active_date = (Time::now())->format('Y-m-d');
                            $this->Customers->save($confirm->customer);
                        }

                    }

                    break;

                default:
                    /* update status */
                    foreach($ids as $vals){
                        $order =  $this->CustomerActivations->get($vals);
                        $order->status = $status;
                        $this->CustomerActivations->save($order);
                    }
                    $this->Flash->success(__('The order has been update.'));
            }


            $result = ['ok'];
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
    }

    public function index()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');
            $status = $this->request->getData('status');

            $type = [
                'pending' => 0,
                'success' => 1,
                'failed' => 2
            ];
            $status = $type[$status];
            /** custom default query : select, where, contain, etc. **/
            $data = $this->CustomerActivations->find('all')
                ->select();
            $data->contain([
                'Images',
                'CustomerBanks' => [
                    'Banks'
                ],
                'Customers' => [
                    'RefferalCustomers'
                ]
            ]);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' => [
                        'Customers.username LIKE' => '%' . $search .'%',
                        'Customers.email LIKE' => '%' . $search .'%'
                    ]]);
                }
                $data->where($query);
            }


            if (isset($status)) {
                $data->where(['CustomerActivations.status' => $status]);
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

            $webroot = $this->getRequest()->getAttribute('webroot');
            $data = $data->map(function (\AdminPanel\Model\Entity\CustomerActivation $row) use ($webroot) {
//                $path = explode(DS,$row->order_confirmation->image->dir);
//                unset($path[0]);
//                $path = implode('/',$path);
//                $row->order_confirmation->image->dir = $path;

                if ($row->image) {
                    $path = explode(DS, $row->image->dir);
                    array_shift($path);
                    if ($webroot != '/') {
                        array_unshift(
                            $path,
                            trim($webroot, '/')
                        );
                    }
                    $path = implode('/', $path);
                    $row->image->dir = $path;
                }

                return $row;
            });

            $result = [];
            $result['data'] = $data->toArray();


            $result['meta'] = array_merge((array) $pagination, (array) $sort);
            $result['meta']['total'] = $total;


            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }

        $statusTypes = [
          '0' => 'Pending',
          '1' => 'Success',
          '2' => 'Failed'
        ];

        /**
         * @var \AdminPanel\Model\Entity\Customer $first_customer
         */
        $first_customer = $this->Customers->find()
            ->orderAsc('id')
            ->first();



        $is_first_customer = $this->Customers->find()->count() == 1 && !$first_customer->upline_id && !$first_customer->refferal_id;

        $networks = $this->Customers->Networks->find('list',  [
            'keyField' => 'customer.id',
            'valueField' => function (\AdminPanel\Model\Entity\Network $network) {
                return $network->customer->email;
            }
        ])->contain([
            'Customers'
        ]);


        $this->set(compact('statusTypes', 'is_first_customer', 'networks'));
    }
}

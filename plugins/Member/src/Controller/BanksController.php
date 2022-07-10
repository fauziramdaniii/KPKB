<?php
namespace Member\Controller;

use Cake\I18n\Time;
use Member\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;


/**
 * Banks Controller
 *
 * @property \AdminPanel\Model\Table\CustomerBanksTable $CustomerBanks
 * @method \Member\Model\Entity\Bank[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BanksController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.CustomerBanks');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $customer_id = $this->Auth->user('id');

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->CustomerBanks->find();

            $data = $data
                ->contain([
                    'Banks'
                ])
                ->where([
                    'CustomerBanks.customer_id' => $customer_id
                ])
                ->whereNull('deleted')
                ->orderDesc('CustomerBanks.id');


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

        $total_bank = $this->CustomerBanks->find()
            ->where([
                'customer_id' => $customer_id
            ])
            ->whereNull('deleted')
            ->count();

        $this->set(compact('total_bank'));
    }



    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer_id = $this->Auth->user('id');

        $total_bank = $this->CustomerBanks->find()
            ->where([
                'customer_id' => $customer_id
            ])
            ->whereNull('deleted')
            ->count();

        if ($total_bank >= 1) {
            $this->Flash->error(__('The bank account already exists'));
            return $this->redirect(['action' => 'index']);
        }

        $customerBank = $this->CustomerBanks->newEntity();
        if ($this->request->is('post')) {

//            $this->CustomerBanks->getValidator('default')
//                ->add('serial', 'check', [
//                    'rule' => function($value) use ($customer_id) {
//                        /**
//                         * @var \AdminPanel\Model\Entity\Customer $check
//                         */
//                        $check = $this->CustomerBanks->Customers->find()
//                            ->select([
//                                'Cards.serial'
//                            ])
//                            ->contain('Cards')
//                            ->where([
//                                'Customers.id' => $customer_id
//                            ])
//                            ->first();
//                        return $check && strtoupper($check->card->serial) === strtoupper($value);
//                    },
//                    'message' => __( 'Invalid serial number')
//                ]);

            $bank = $this->CustomerBanks->patchEntity($customerBank, $this->request->getData());
            $bank->customer_id = $customer_id;
            if ($this->CustomerBanks->save($customerBank)) {
                $this->Flash->success(__('The bank has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bank could not be saved. Please, try again.'));
        }

        $banks = $this->CustomerBanks->Banks->find('list')
            ->orderAsc('id')->limit(7);
        $this->set(compact('customerBank', 'banks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bank id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $customer_id = $this->Auth->user('id');

        $customerBank = $this->CustomerBanks->find()
            ->where([
                'customer_id' => $customer_id,
                'id' => $id
            ])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {

//            $this->CustomerBanks->getValidator('default')
//                ->add('serial', 'check', [
//                    'rule' => function($value) use ($customer_id) {
//                        /**
//                         * @var \AdminPanel\Model\Entity\Customer $check
//                         */
//                        $check = $this->CustomerBanks->Customers->find()
//                            ->select([
//                                'Cards.serial'
//                            ])
//                            ->contain('Cards')
//                            ->where([
//                                'Customers.id' => $customer_id
//                            ])
//                            ->first();
//                        return $check && strtoupper($check->card->serial) === strtoupper($value);
//                    },
//                    'message' => __( 'Invalid serial number')
//                ]);

            $customerBank = $this->CustomerBanks->patchEntity($customerBank, $this->request->getData());
            $customerBank->customer_id = $customer_id; //re set again
            if ($this->CustomerBanks->save($customerBank)) {
                $this->Flash->success(__('The bank has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bank could not be saved. Please, try again.'));
        }

        $banks = $this->CustomerBanks->Banks->find('list')
            ->orderAsc('id')->limit(7);;
        $this->set(compact('customerBank', 'banks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bank id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $customer_id = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);

        //check serial number

        /**
         * @var \AdminPanel\Model\Entity\Customer $serial
         */
        $serial = $this->CustomerBanks->Customers->find()
            ->select(['password'])
            ->where([
                'Customers.id' => $customer_id
            ])
            ->first();

        if ($serial) {
            if (!(new DefaultPasswordHasher())->check($this->request->getData('serial') , $serial->password)) {
                return $this->response->withStatus('403', __( 'Invalid serial number'))
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'status' => 'ERROR',
                        'message' => __( 'Invalid serial number')
                    ]));
            }else{

                /**
                 * @var \AdminPanel\Model\Entity\CustomerBank $bank
                 */
                $bank = $this->CustomerBanks->find()
                    ->where([
                        'customer_id' => $customer_id,
                        'id' => $id
                    ])->first();

                if ($bank) {
                    $bank->deleted = (Time::now())->format('Y-m-d H:i:s');
                }
                if ($this->CustomerBanks->save($bank)) {
                    $this->Flash->success(__('The bank has been deleted.'));
                    return $this->response->withStatus('200');
                } else {
                    return $this->response->withStatus('403', __( 'The bank could not be deleted. Please, try again.'))
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'status' => 'ERROR',
                            'message' => __( 'The bank could not be deleted. Please, try again.')
                        ]));
                }
            }
        }

    }
}

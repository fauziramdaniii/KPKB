<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use Cake\Cache\Cache;
use Cake\Routing\Route\Route;
use Cake\Routing\Router;
use Cake\Utility\Security;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

/**
 * Customers Controller
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \AdminPanel\Model\Table\CustomerBanksTable $CustomerBanks
 *
 * @method \AdminPanel\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('AdminPanel.Customers');
        $this->loadModel('AdminPanel.CustomerBanks');
    }

    public function forceLogin($customer_id)
    {
        $this->disableAutoRender();
        $securityKey = Security::randomString();
        if (Cache::write($customer_id, $securityKey, 'forceLogin')) {
            return $this->redirect([
                'controller' => 'Login',
                'action' => 'forceLogin',
                'plugin' => false,
                $customer_id,
                $securityKey
            ]);
        } else {
            return $this->redirect($this->referer());
        }
    }


    /**
     * @throws \Exception
     */
    public function export()
    {
        $sort = $this->request->getQuery('sort');
        $query = $this->request->getQuery('query');

        try {
           $export = $this->ExportExcel->init(null, false)
                ->addHeader([
                    'id',
                    'Username',
                    'Full Name',
                    'Referral',
                    'Referral Name',
                    'Email',
                    'Phone',
                    'Dob',
                    'Identity Number',
                    'NPWP',
                    'Religion',
                    'Education',
                    'Kewarganegaraan'
                ]);


           $data = $this->Customers->find()
                ->contain([
                    'RefferalCustomers',
                    'CustomerTypes',
                    'Religions',
                    'Educations',
                    'Countries',
                ])
                ->whereInList('Customers.is_active', [ 1,2 ]);

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
                        'RefferalCustomers.username LIKE' => '%' . $search .'%',
                        'Customers.email LIKE' => '%' . $search .'%',
                        'Customers.first_name LIKE' => '%' . $search .'%',
                        'Customers.last_name LIKE' => '%' . $search .'%',
                    ]]);
                }
                if (isset($query['is_active'])) {
                    $is_active = $query['is_active'];
                    unset($query['is_active']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Customers.is_active' => $is_active]);
                }
                //$data->where($query);
            }

            if (isset($sort['field']) && isset($sort['sort'])) {
                $data->order([$sort['field'] => $sort['sort']]);
            }

           $data = $data
               ->map(function(\AdminPanel\Model\Entity\Customer $row) use ($export) {
                   $export->addRow([
                       $row->id,
                       $row->username,
                       $row->full_name,
                       $row->refferal_customer ? $row->refferal_customer->username : '-',
                       $row->refferal_customer ? $row->refferal_customer->full_name : '-',
                       $row->email,
                       (string) $row->phone,
                       $row->dob instanceof \Cake\I18n\FrozenDate ? $row->dob->format('Y-m-d') : '-',
                       (string) $row->identity_number,
                       (string) $row->npwp,
                       $row->religion ? $row->religion->name : '-',
                       $row->education ? $row->education->name : '-',
                       $row->country ? $row->country->name : '-',
                   ], true);
                   return $row;
               })
               ->toArray();

           return $export->close();
        } catch (\Exception $e) {
            throw  new \Exception($e->getMessage());
        }

    }

    /**
     * Index method list
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Customers->find('all')
                ->contain([
                    'RefferalCustomers'
                ])
                //->where(['Customers.is_active IN' => [1,2]])
                ->select();
            $data->contain(['CustomerTypes']);

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
                        'RefferalCustomers.username LIKE' => '%' . $search .'%',
                        'Customers.email LIKE' => '%' . $search .'%',
                        'Customers.first_name LIKE' => '%' . $search .'%',
                        'Customers.last_name LIKE' => '%' . $search .'%',
                    ]]);
                }
                if (isset($query['is_active'])) {
                    $is_active = $query['is_active'];
                    unset($query['is_active']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Customers.is_active' => $is_active]);
                }
                //$data->where($query);
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


        //$this->set(compact('customers'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => [
                'RefferalCustomers'
            ]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->request->getData('password') === '') {
                $this->request = $this->request->withoutData('password');
            }
            $validator = $this->Customers->getValidator('default');
            $validator->remove('username')
                ->remove('email')
                ->remove('phone')
                ->allowEmptyString('password');
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));
                if ($redirect = $this->getRequest()->getQuery('redirect')) {
                    $path = array_filter(explode('/', $redirect));
                    array_shift($path);
                    array_unshift($path, '');
                    $path = implode('/', $path);
                    return $this->redirect($path);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $countries = $this->Customers->Countries->find('list', ['limit' => 200]);
        //$cards = $this->Customers->Cards->find('list', ['limit' => 200]);
        $customer_types = $this->Customers->CustomerTypes->find('list', ['limit' => 200]);
        $religions = $this->Customers->Religions->find('list');
        $educations = $this->Customers->Educations->find('list');
        $this->set(compact('customer', 'countries', 'customer_types', 'religions', 'educations'));
    }


    public function editBank($id = null)
    {
        $customerBank = $this->CustomerBanks->find()
            ->where([
                'customer_id' => $id
            ])
            ->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customerBank = $this->CustomerBanks->patchEntity($customerBank, $this->request->getData());
            $customerBank->customer_id = $id; //re set again
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
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function waiting()
    {


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Customers->find('all')
                ->where(['Customers.is_active IN' => [0]])
                ->select();
            $data->contain(['CustomerTypes']);

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
                //$data->where($query);
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


        //$this->set(compact('customers'));
    }

}

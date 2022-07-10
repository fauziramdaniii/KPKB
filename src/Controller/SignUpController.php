<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use AdminPanel\Model\Entity\TransactionType;

/**
 * SignUp Controller
 *
 *
 * @method \App\Model\Entity\SignUp[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \AdminPanel\Model\Table\ProvincesTable $Provinces
 * @property \AdminPanel\Model\Table\CitiesTable $Cities
 * @property \AdminPanel\Model\Table\SubdistrictsTable $Subdistricts
 * @property \AdminPanel\Model\Table\CustomerBanksTable $CustomerBanks
 * @property \AdminPanel\Model\Table\CustomerAddressTable $CustomerAddress
 * @property \AdminPanel\Model\Table\GenerationsTable $Generations
 */
class SignUpController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Customers');
        $this->loadModel('AdminPanel.Provinces');
        $this->loadModel('AdminPanel.Cities');
        $this->loadModel('AdminPanel.Subdistricts');
        $this->loadModel('AdminPanel.CustomerBanks');
        $this->loadModel('AdminPanel.CustomerAddress');
        $this->loadModel('AdminPanel.Generations');
    }

    public function getCities()
    {
        $this->getRequest()->allowMethod('post');

        if ($province_id = $this->getRequest()->getData('id')) {
            $cities = $this->CustomerAddress->Cities->find('list', [
                'keyField' => 'id',
                'valueField' => function (\AdminPanel\Model\Entity\City $city) {
                    return $city->get('type') . ' ' . $city->get('name');
                }
            ])
                ->where([
                    'province_id' => $province_id
                ])
                ->toArray();

            return $this->getResponse()->withType('application/json')
                ->withStringBody(json_encode($cities));
        }


    }

    public function getDistricts()
    {
        $this->getRequest()->allowMethod('post');

        if ($city_id = $this->getRequest()->getData('id')) {
            $cities = $this->CustomerAddress->Subdistricts->find('list')
                ->where([
                    'city_id' => $city_id
                ])
                ->toArray();

            return $this->getResponse()->withType('application/json')
                ->withStringBody(json_encode($cities));
        }


    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('register');
        $customer = $this->Customers->newEntity(null);

        $cities = [];
        $subdistricts = [];

        if ($this->request->is('post')) {

            $province_id = $this->getRequest()->getData('customer_address.province_id');
            $city_id = $this->getRequest()->getData('customer_address.city_id');

            $cities = $this->Cities
                ->find('list', [
                    'keyField' => 'id',
                    'valueField' => function (\AdminPanel\Model\Entity\City $city) {
                        return $city->get('type') . ' ' . $city->get('name');
                    }
                ])
                ->where([
                    'province_id' => $province_id
                ]);

            $subdistricts = $this->Subdistricts->find('list')
                ->where([
                    'city_id' => $city_id
                ]);


            $secret = Configure::read('GoogleCaptcha.secretKey');
            $gResponse = $this->request->getData('g-recaptcha-response');
            $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$gResponse);
            $res = json_decode($verify);
            if($res->success){

                $customerTotal = $this->Customers->find()
                    ->count();

                $validator = $this->Customers->getValidator('default');
                $validator
                    ->remove('heir')
                    ->remove('heir_relation')
                    ->remove('gender')
                    ->date('dob')
                    ->allowEmptyString('npwp')
                    ->numeric('npwp');


                /*
                $validatorCustomerBank = $this->CustomerBanks->getValidator('default');

                $validator->addNested('customer_bank', $validatorCustomerBank);


                $validatorCustomerAddress = $this->CustomerAddress->getValidator('default');

                $validator->addNested('customer_address', $validatorCustomerAddress);
                */

                /**
                 * @var \AdminPanel\Model\Entity\Customer|null $referralEntity
                 */
                $referralEntity = null;
                if ($customerTotal > 0) {
                    $validator->allowEmptyString('refferal');
                    $validator->allowEmptyString('upline');
                    if(!empty($this->request->getData('refferal'))){
                        $referralEntity = $this->Customers->find()
                            ->select('id')
                            ->where([
                                'username' => $this->request->getData('refferal'),
                                'is_active' => 1
                            ])
                            ->first();
                        $validator->notBlank('refferal')
                            ->add('refferal', 'exists', [
                                'rule' => function($value) use ($referralEntity) {
                                    return $referralEntity && $referralEntity->has('id');
                                },
                                'message' => __('Refferal not exists')
                            ])
                            ->remove('upline');
                    }


                    if(!empty($this->request->getData('upline'))) {
                        $refferal = $this->request->getData('refferal');
                        /**
                         * @var \AdminPanel\Model\Entity\Network $network_id
                         */
                        $network_id = $this->Customers->Networks->find()
                            ->contain([
                                'Customers'
                            ])
                            ->where([
                                'Customers.username' => $refferal,
                                'is_active' => 1
                            ])
                            ->first();




                        $validator->notBlank('upline')
                            ->add('upline', 'exists', [
                                'rule' => function($value) use($network_id)  {

                                    $exists_upline = $this
                                        ->Customers
                                        ->Networks
                                        ->find()
                                        ->contain(['Customers'])
                                        ->where([
                                            'Customers.username' => $value,
                                            'Customers.is_active' => 1
                                        ])
                                        ->first();

                                    if ($exists_upline && $this->Customers->Networks->find('children', ['for' => $network_id->id])->count()  <= 1) {
                                        return true;
                                    }

                                    return $network_id  && ($this
                                                ->Customers
                                                ->Networks
                                                ->find('children', ['for' => $network_id->id])
                                                ->contain(['Customers'])
                                                ->where([
                                                    'Customers.username' => $value,
                                                    'Customers.is_active' => 1
                                                ])
                                                ->count() > 0 || strtolower($network_id->customer->username) == strtolower($value));
                                },
                                'message' => __('Invalid upline')
                            ]);
                    }

                }

                $emailExplode = explode('@', $this->request->getData('email'));

                $customer = $this->Customers->patchEntity($customer, $this->request->getData());

                /*
                $prefix = Configure::read('Prefixes.username', [
                    'prefix' => 'TST',
                    'number' => 1000000
                ]);
                */

                $customer->set('username',$emailExplode[0]);
                $customer->set('code_reff',md5(uniqid(rand(), true)));
                $customer->set('approval',1);
                $customer->set('customer_type_id',1);
                $customer->set('is_active',0);
                $customer->set('rank_id',null);
                $customer->set('balance',0);

                if ($referralEntity) {
                    $customer->set('refferal_id', $referralEntity->get('id'));
                    $customer->set('upline_id', $referralEntity->get('id'));
                } else if ($customerTotal > 0) {
                    //not exists
                    $referralEntity = $this->Customers->find()
                        ->orderAsc('Customers.id')
                        ->first();

                    // Set upline manual
                    // $referralEntity = $this->Customers->find()
                    //   ->where(['Customers.id' => 2])
                    //    ->orderAsc('Customers.id')
                    //    ->first();

                    $customer->set('refferal_id', $referralEntity->get('id'));
                    $customer->set('upline_id', $referralEntity->get('id'));
                }

                $customer->balance = 0;
                if ($this->Customers->save($customer)) {

                    //$customer->username = $prefix['prefix'] . ($prefix['number'] + $customer->id);
                    $customer->username = $emailExplode[0];
                    $this->Customers->save($customer);

                    /**
                     * @var \AdminPanel\Model\Entity\Customer|null $getCustomerByUpline
                     */
                    $getCustomerByUpline = null;
                    if ($upline = $this->getRequest()->getData('upline') && !$customer->upline_id) {
                        //find customer_id by upline username
                        /**
                         * @var \AdminPanel\Model\Entity\Customer $getCustomerByUpline
                         */
                        $getCustomerByUpline = $this->Customers->find()
                            ->select(['id'])
                            ->where([
                                'username' => $upline
                            ])
                            ->first();

                        if ($getCustomerByUpline) {
                            $this->Customers->query()
                                ->update()
                                ->set([
                                    'upline_id' => $getCustomerByUpline->id
                                ])
                                ->where([
                                    'id' => $customer->id
                                ])
                                ->execute();
                        }
                    }


                    //set in activation
                    if ($customerTotal == 0) {
                        $this->Customers->Networks->saving(null, $customer->id);
                    } else if ($referralEntity) {
                        //get parent_id of network
                        $this->Customers->Networks->saving($referralEntity->id, $customer->id);
                    }

                    $this->Generations->saving(
                        $customer->refferal_id,
                        $customer->id
                    );

                    $customerAdressEntity = $this->CustomerAddress->newEntity($this->getRequest()->getData('customer_address'));

                    $customerAdressEntity->customer_id = $customer->id;
                    $customerAdressEntity->receiver_name = $customer->first_name . ' ' . $customer->last_name;
                    $customerAdressEntity->receiver_phone = $customer->phone;
                    $customerAdressEntity->primary = 1;
                    $this->CustomerAddress->save($customerAdressEntity);


                    //customer_bank hasOne entity auto save
                    //$customerBankEntity = $this->CustomerBanks->newEntity($this->getRequest()->getData('customer_bank'));
                    //$customerBankEntity->customer_id = $customer->id;
                    //$this->CustomerBanks->save($customerBankEntity);

                    $this->request->getSession()->delete('Refferal');
                    $this->Flash->success(__('Pendaftaran Berhasil, silahkan masuk ke Akun anda.'));


                    return $this->redirect(['controller' => 'Login', 'action' => 'index']);

                }else{

                    $this->Flash->error(__('Registration failed. Check the form and try again.'));
                }
            }else{
                $this->Flash->error(__('Invalid captcha'));
            }


            /*
            if(!$this->request->getData('tos')){
                $this->Flash->error(__('Please check the terms and conditions first'));
                //$this->redirect(['action' => 'index']);
            }else{

                $secret = Configure::read('GoogleCaptcha.secretKey');
                $gResponse = $this->request->getData('g-recaptcha-response');
                $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$gResponse);
                $res = json_decode($verify);
                if($res->success){

                    $customerTotal = $this->Customers->find()
                        ->count();

                    $validator = $this->Customers->getValidator('default');
                    $validator
                        ->remove('heir')
                        ->remove('heir_relation')
                        ->remove('gender')
                        ->date('dob')
                        ->allowEmptyString('npwp')
                        ->numeric('npwp');


                    $validatorCustomerBank = $this->CustomerBanks->getValidator('default');

                    $validator->addNested('customer_bank', $validatorCustomerBank);


                    $validatorCustomerAddress = $this->CustomerAddress->getValidator('default');

                    $validator->addNested('customer_address', $validatorCustomerAddress);

                    $referralEntity = null;
                    if ($customerTotal > 0) {
                        $validator->allowEmptyString('refferal');
                        $validator->allowEmptyString('upline');
                        if(!empty($this->request->getData('refferal'))){
                            $referralEntity = $this->Customers->find()
                                ->select('id')
                                ->where([
                                    'username' => $this->request->getData('refferal'),
                                    'is_active' => 1
                                ])
                                ->first();
                            $validator->notBlank('refferal')
                                ->add('refferal', 'exists', [
                                    'rule' => function($value) use ($referralEntity) {
                                        return $referralEntity && $referralEntity->has('id');
                                    },
                                    'message' => __('Refferal not exists')
                                ])
                                ->remove('upline');
                        }



                        if(!empty($this->request->getData('upline'))) {
                            $refferal = $this->request->getData('refferal');
                            $network_id = $this->Customers->Networks->find()
                                ->contain([
                                    'Customers'
                                ])
                                ->where([
                                    'Customers.username' => $refferal,
                                    'is_active' => 1
                                ])
                                ->first();




                            $validator->notBlank('upline')
                                ->add('upline', 'exists', [
                                    'rule' => function($value) use($network_id)  {

                                        $exists_upline = $this
                                            ->Customers
                                            ->Networks
                                            ->find()
                                            ->contain(['Customers'])
                                            ->where([
                                                'Customers.username' => $value,
                                                'Customers.is_active' => 1
                                            ])
                                            ->first();

                                        if ($exists_upline && $this->Customers->Networks->find('children', ['for' => $network_id->id])->count()  <= 1) {
                                            return true;
                                        }

                                        return $network_id  && ($this
                                                ->Customers
                                                ->Networks
                                                ->find('children', ['for' => $network_id->id])
                                                ->contain(['Customers'])
                                                ->where([
                                                    'Customers.username' => $value,
                                                    'Customers.is_active' => 1
                                                ])
                                                ->count() > 0 || strtolower($network_id->customer->username) == strtolower($value));
                                    },
                                    'message' => __('Invalid upline')
                                ]);
                        }

                    }

                    $emailExplode = explode('@', $this->request->getData('email'));

                    $customer = $this->Customers->patchEntity($customer, $this->request->getData());

                    $prefix = Configure::read('Prefixes.username', [
                        'prefix' => 'TST',
                        'number' => 1000000
                    ]);

                    $customer->set('username',$emailExplode[0]);
                    $customer->set('code_reff',md5(uniqid(rand(), true)));
                    $customer->set('approval',1);
                    $customer->set('customer_type_id',1);
                    $customer->set('is_active',0);
                    $customer->set('rank_id',null);
                    $customer->set('balance',0);

                    if ($referralEntity) {
                        $customer->set('refferal_id', $referralEntity->get('id'));
                        $customer->set('upline_id', $referralEntity->get('id'));
                    } else if ($customerTotal > 0) {
                        //not exists
                        $referralEntity = $this->Customers->find()
                            ->orderAsc('Customers.id')
                            ->first();

                        // Set upline manual
                         // $referralEntity = $this->Customers->find()
                         //   ->where(['Customers.id' => 2])
                         //    ->orderAsc('Customers.id')
                         //    ->first();

                        $customer->set('refferal_id', $referralEntity->get('id'));
                        $customer->set('upline_id', $referralEntity->get('id'));
                    }

                    $customer->balance = 0;
                    if ($this->Customers->save($customer)) {

                        $customer->username = $prefix['prefix'] . ($prefix['number'] + $customer->id);
                        $this->Customers->save($customer);

                        $getCustomerByUpline = null;
                        if ($upline = $this->getRequest()->getData('upline') && !$customer->upline_id) {
                            //find customer_id by upline username
                            $getCustomerByUpline = $this->Customers->find()
                                ->select(['id'])
                                ->where([
                                    'username' => $upline
                                ])
                                ->first();

                            if ($getCustomerByUpline) {
                                $this->Customers->query()
                                    ->update()
                                    ->set([
                                        'upline_id' => $getCustomerByUpline->id
                                    ])
                                    ->where([
                                        'id' => $customer->id
                                    ])
                                    ->execute();
                            }
                        }


                        //set in activation
                        if ($customerTotal == 0) {
                            $this->Customers->Networks->saving(null, $customer->id);
                        } else if ($referralEntity) {
                            //get parent_id of network
                            $this->Customers->Networks->saving($referralEntity->id, $customer->id);
                        }

                        $this->Generations->saving(
                            $customer->refferal_id,
                            $customer->id
                        );

                        $customerAdressEntity = $this->CustomerAddress->newEntity($this->getRequest()->getData('customer_address'));

                        $customerAdressEntity->customer_id = $customer->id;
                        $customerAdressEntity->receiver_name = $customer->first_name . ' ' . $customer->last_name;
                        $customerAdressEntity->receiver_phone = $customer->phone;
                        $customerAdressEntity->primary = 1;
                        $this->CustomerAddress->save($customerAdressEntity);


                        //customer_bank hasOne entity auto save
                        //$customerBankEntity = $this->CustomerBanks->newEntity($this->getRequest()->getData('customer_bank'));
                        //$customerBankEntity->customer_id = $customer->id;
                        //$this->CustomerBanks->save($customerBankEntity);

                        $this->request->getSession()->delete('Refferal');
                        $this->Flash->success(__('Registration success, please login to your account and complete activation account.'));


                        return $this->redirect(['controller' => 'Login', 'action' => 'index']);

                    }else{

                        $this->Flash->error(__('Registration failed. Check the form and try again.'));
                    }
                }else{
                    $this->Flash->error(__('Invalid captcha'));
                }
            }
            */

        }

        $provinces = $this->Provinces->find('list');

        $banks = $this->CustomerBanks->Banks->find('list')
            ->orderAsc('id')->limit(7);

        $countries = $this->Customers->Countries->find('list');

        $educations = $this->Customers->Educations->find('list');
        $religions = $this->Customers->Religions->find('list');

        $this->set(compact('customer', 'provinces', 'cities', 'subdistricts', 'banks', 'countries', 'educations', 'religions'));

    }


}

<?php
namespace Member\Controller;

use Member\Controller\AppController;

/**
 * Profiles Controller
 *
 *
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 */
class ProfilesController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Customers');
    }

    /**
     * Index method
     *
     */
    public function index()
    {
        $customer_id = $this->Auth->user('id');


        /**
         * @var \AdminPanel\Model\Entity\Customer $customer
         */
        $customer = $this->Customers->get($customer_id, [
            'contain' => [
                'RefferalCustomers'
            ]
        ]);


        if ($customer) {
            if ($customer->dob) {
                $customer->dob = $customer->dob->format('Y-m-d');
            }
        }

        if ($this->request->is(['post', 'put'])) {

//            $this->Customers->getValidator('default')
//                ->add('serial', 'check', [
//                    'rule' => function($value) use ($customer) {
//                        return strtoupper($customer->card->serial) === strtoupper($value);
//                    },
//                    'message' => __( 'Invalid serial number')
//                ]);

            $entity = $this->Customers->patchEntity($customer, $this->getRequest()->getData(), [
                'fields' => [
                    'avatar',
                    'email',
                    'first_name',
                    'last_name',
                    'dob',
                    'phone',
                    'identity_number',
                    'npwp',
                    'country_id',
                    'heir',
                    'heir_relation',
                    'heir_address',
                    'heir_country_id',
                    'religion_id',
                    'education_id',
                ]
            ]);

            //debug($customer); exit;

            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The profile has been changed.'));
                $session = $this->Auth->user();
                $session['avatar'] = $customer->get('avatar');

                $this->Auth->setUser($session);


            } else {
                $this->Flash->error(__('The profile could not be saved. Please, try again.'));
            }

        }

        $countries = $this->Customers->Countries->find('list');
        $educations = $this->Customers->Educations->find('list');
        $religions = $this->Customers->Religions->find('list');

        $this->set(compact('customer', 'countries', 'educations', 'religions'));
    }


    public function changePassword()
    {
        //debug($this->getRequest()->getParam('action'));exit;

        $clientId = $this->Auth->user('id');




        $customer = $this->Customers->get($clientId);

        if ($this->request->is('put')) {

            //register Sendauth with name and client id



            $this->Customers->getValidator('password')
                ->add('current_password', 'custom', [
                    'rule' => function($value, $context) use ($customer) {
                        return (new \Cake\Auth\DefaultPasswordHasher())->check($value, $customer->get('password'));
                    },
                    'message' => __( "Old password doesn't match")
                ]);

            $entity = $this->Customers->patchEntity($customer, $this->request->getData(), [
                'validate' => 'password',
                'fields' => [
                    'password'
                ]
            ]);
            if ($this->Customers->save($entity)) {
                $this->request = $this->getRequest()->withoutData('current_password');
                $this->request = $this->getRequest()->withoutData('auth_code');
                $this->Flash->success(__('The password has been changed.'));
            } else {
                $this->Flash->error(__('The password could not be saved. Please, try again.'));
            }

        }

        $this->set(compact('customer'));



    }

    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect([
            'controller' => 'Dashboard',
            'action' => 'index'
        ]);
    }


}

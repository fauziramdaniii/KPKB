<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Form\Form;

/**
 * Home Controller
 *
 *
 * @method \App\Model\Entity\Reset[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 */
class ResetController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Customers');
    }

    public function index($code = null){

        $this->viewBuilder()->setLayout('login');

        $customer = new Form();
        if (is_null($code)) {
            $this->Flash->error(__('Invalid reset code'));
        }else{

            $customer = $this->Customers->find()
                ->where(['activation_code' => $code, 'timeout >' => time()])
                ->first();
            if($customer){
                if (!empty($this->request->getData())) {

                    $this->Customers->getValidator('passwords');
                    $entity = $this->Customers->patchEntity($customer, $this->request->getData(), [
                        'validate' => 'passwords',
                        'fields' => [
                            'password'
                        ]
                    ]);
                    $entity->activation_code = null;
                    $entity->timeout = null;
                    if ($this->Customers->save($entity)) {
                        $this->Flash->success(__('The password has been changed.'));
                        return $this->redirect(array('controller' => 'login', 'action' => 'index'));
                    } else {
                        $this->Flash->error(__('The password could not be updated.'));
                    }
                }
            }else{
                $this->Flash->error(__('Invalid reset code'));
            }

            $this->set(compact('customer'));
        }


    }
}

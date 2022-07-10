<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\LoginForm;
use Cake\Core\Configure;

/**
 * SignUp Controller
 *
 *
 * @method \App\Model\Entity\ForgotPassword[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 */
class ForgotPasswordController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Customers');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('login');

        $login =  new LoginForm();
        if ($this->request->is('post')) {

            $secret = Configure::read('GoogleCaptcha.secretKey');
            $gResponse = $this->request->getData('g-recaptcha-response');
            $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$gResponse);
            $res = json_decode($verify);
            if($res->success){

                $customer = $this->Customers->find()
                    ->where(['email' => $this->request->getData('email')])
                    ->first();

                if (is_null($customer)) {
                    $this->Flash->error(__('Email address does not exist.'));
                } else {
                    $passkey = \Cake\Utility\Text::uuid();
                    $timeout = time() + DAY;
                    if ($this->Customers->updateAll(['activation_code' => $passkey, 'timeout' => $timeout], ['id' => $customer->id])){

                        $this->Flash->success(__('Email with instructions for creating a new password has been sent to you.'));
                        /* SEND EMAIL ACTIVATION */

                        $this->Mailer
                            ->setVar([
                                'code' => $passkey
                            ])
                            ->send($customer->id, 'Forgotten Password','forgot_password');

                        $this->redirect(['controller' => 'login', 'action' => 'index']);

                    } else {
                        $this->Flash->error(__('Error saving reset passkey/timeout'));
                    }
                }

            }else{
                $this->Flash->error(__('Invalid captcha'));
            }
        }
        $this->set('login', $login);

    }

}

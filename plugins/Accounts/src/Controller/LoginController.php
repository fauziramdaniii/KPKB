<?php
namespace Accounts\Controller;

use Accounts\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Http\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

/**
 * Login Controller
 *
 *
 * @method \Accounts\Model\Entity\Login[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 */
class LoginController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Customers');
        $this->Auth->allow(['index']);
    }


    public function test()
    {
        $data = [555];
        $this->set(compact('data'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->request->allowMethod('post');

        /**
         * @var \AdminPanel\Model\Entity\Customer $findCustomer
         */
        $findCustomer = $this->Customers->find()
            ->select(['id', 'first_name', 'last_name', 'username', 'email', 'is_active', 'password'])
            ->where([
                'OR' => [
                'username' => $this->request->getData('email'),
                'email' => $this->request->getData('email')
                ]
            ])
            ->first();

        $customer = null;
        $error = [
            'email' => null,
            'password' => null
        ];

        if ($findCustomer) {
            switch ($findCustomer->is_active){
                case '0':

                    $this->Flash->error(__('This account not yet active.'));
                    break;

                case '1':

                    $password = $this->request->getData('password');
                    $hasher = new DefaultPasswordHasher();
                    if($hasher->check($password, $findCustomer->password)){
                        $this->Customers->updateAll(['last_login' => time()], ['id' => $findCustomer->id] );
                        $this->Auth->setUser($findCustomer);
                    }else {
                        //throw new UnauthorizedException('Invalid password');
                        $this->response = $this->response->withStatus(401, 'Invalid password');
                        $error['password'] = 'Invalid password';
                    }

                    break;

                case '2':
                    //throw new UnauthorizedException('This account is blocked');
                    $this->response = $this->response->withStatus(401, 'This account is blocked');
                    $error['email'] = 'This account is blocked';
                    break;
            }

            $customer = clone $findCustomer;
            unset($customer->password);
        } else {
            //throw new UnauthorizedException('The account not found.');
            $this->response = $this->response->withStatus(401, 'The account not found');
            $error['email'] = 'The account not found';
        }


        if ($this->response->getStatusCode() == 200) {
            $access_token = JWT::encode(
                [
                    'sub' => $findCustomer->id,
                    'exp' =>  time() + 604800,
                    'token' => Security::randomString()
                ],
                Security::getSalt());
            $user = $customer;
        } else {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'ERROR',
                    'code' => $this->response->getStatusCode(),
                    'error' => $error
                ]));
        }


        $this->set(compact('access_token', 'user'));
    }


}

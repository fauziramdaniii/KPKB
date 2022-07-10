<?php
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Home Controller
 *
 *
 * @method \App\Model\Entity\Auth[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])

 */
class AuthController extends AppController
{

    public $sessionKey = 'Auth.Customers';
    /**
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Login',
                'action' => 'index',
                'plugin' => false
            ],
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index',
                'plugin' => 'Member',
                'lang' => 'id'
            ],
            'authError' => __( 'Did you really think you are allowed to see that?'),
            'authenticate' => [
                'Form' => [
                    'finder' => 'auth',
                    'userModel' => 'Customers',
                    'fields' => ['username' => 'email']
                ]
            ],
            'unauthorizedRedirect' => false,
            'storage' => [
                'className' => 'Session',
                'key' => $this->sessionKey
            ],
        ]);
    }

}

<?php


namespace Accounts\Controller;

/**
 * Class AuthController
 * @package Accounts\Controller
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 */
class AuthController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Customers');
    }

    public function accessToken()
    {
        $this->request->allowMethod('get');

        $access_token = null;

        $bearer = $this->getRequest()->getHeader('Authorization');
        if ($bearer && count($bearer) > 0) {
            $bearer = $bearer[0];
            list($key, $access_token) = preg_split('/\s+/i', $bearer);
        }

        $user = $this->Auth->user();

        $data = [
            'uuid' => 'XgbuVEXBU5gtSKdbQRP1Zbbby1i1',
            'from' => 'custom-db',
            'role' => 'admin',
            'data' =>
                [
                    'displayName' => $user['first_name'],
                    'photoURL' => 'assets/images/avatars/Abbott.jpg',
                    'email' => $user['email'],
                    'settings' =>
                        [
                            'layout' =>
                                [
                                    'style' => 'layout1',
                                    'config' =>
                                       [
                                            'scroll' => 'content',
                                            'navbar' =>
                                                [
                                                    'display' => true,
                                                    'folded' => true,
                                                    'position' => 'left',
                                                ],
                                            'toolbar' =>
                                               [
                                                    'display' => true,
                                                    'style' => 'fixed',
                                                    'position' => 'below',
                                                ],
                                            'footer' =>
                                                [
                                                    'display' => true,
                                                    'style' => 'fixed',
                                                    'position' => 'below',
                                                ],
                                            'mode' => 'fullwidth',
                                        ],
                                ],
                            'customScrollbars' => true,
                            'theme' =>
                                [
                                    'main' => 'default',
                                    'navbar' => 'defaultDark',
                                    'toolbar' => 'defaultDark',
                                    'footer' => 'defaultDark',
                                ],
                        ],
                    'shortcuts' =>
                        [
                            0 => 'calendar',
                            1 => 'mail',
                            2 => 'contacts',
                        ],
                ],
        ];


        return $this->getResponse()->withType('application/json')
            ->withStringBody(json_encode([
                'user' => $data,
                'access_token' => $access_token
            ]));

    }


}
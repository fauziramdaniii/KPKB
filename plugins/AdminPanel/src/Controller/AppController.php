<?php

namespace AdminPanel\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;
use Cake\Routing\Router;

/**
 *
 * @property \AdminPanel\Model\Table\MenuAdminsTable $MenuAdmins
 *
 * @method \AdminPanel\Model\Entity\MenuAdmins[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property \AdminPanel\Controller\Component\MailerComponent $Mailer
 * @property \AdminPanel\Controller\Component\StatisticComponent $Statistic
 * @property \AdminPanel\Controller\Component\ExportExcelComponent $ExportExcel
 */

class AppController extends BaseController
{
    public function initialize()
    {
        //parent::initialize();

        $this->loadModel('AdminPanel.MenuAdmins');
        $this->loadComponent('AdminPanel.Mailer');
        $this->loadComponent('AdminPanel.Breadcrumb');
        $this->loadComponent('Flash');
        $this->loadComponent('Acl.Acl');
        $this->loadComponent('Statistic');
        $this->loadComponent('AdminPanel.ExportExcel');
        $this->loadComponent('Auth', [
            'authorize' => [
                'Acl.Actions' => [
                    'actionPath' => 'controllers/',
                    'userModel' => 'Users',
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
                'plugin' => 'AdminPanel'
            ],
            'authError' => 'Did you really think you are allowed to see that?',
            'authenticate' => [
                'Form' => [
                    'finder' => 'auth',
                    'userModel' => 'AdminPanel.Users',
                    'fields' => ['username' => 'email']
                ]
            ],
            'unauthorizedRedirect' => false,
            'storage' => [
                'className' => 'Session',
                'key' => 'Auth.Users',
            ],
        ]);

        $lang = $this->getRequest()->getParam('lang');

        $this->Breadcrumb->push(
            [
                'title' => '',
                'url' => Router::url(['controller' => 'Dashboard', 'action' => 'index', 'lang' => $lang]),
            ]
        );
        $this->Breadcrumb->push(
            [
                'title' => $this->request->getParam('controller'),
                'url' => Router::url([
                    'controller' => $this->request->getParam('controller'),
                    'action' => $this->request->getParam('action'),
                    'lang' => $lang
                ]),
            ]
        );

        if ($this->Auth->user('group_id')) {
            $menus = $this->MenuAdmins->find('threaded')->order(['MenuAdmins.lft' => 'ASC'])->toArray();
            $auth_info = $this->Auth->user();
            $this->set(compact('menus','auth_info'));

        }
	}

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->setClassName('AdminPanel.App');

    }
}

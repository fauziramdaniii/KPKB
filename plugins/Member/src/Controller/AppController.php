<?php

namespace Member\Controller;

use App\Controller\AuthController as BaseController;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @property \AdminPanel\Controller\Component\MailerComponent $Mailer
 * @property \AdminPanel\Controller\Component\StatisticComponent $Statistic
 */
class AppController extends BaseController
{

    /**
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Statistic');
        $this->loadComponent('AdminPanel.Mailer');
    }

    public function beforeFilter(Event $event)
    {

//        $is_active = $this->Auth->user('is_active');
//        $allowedController = ['Activation', 'Dashboard', 'Banks', 'Profiles'];
//
//        if (!$is_active && !in_array($this->getRequest()->getAttribute('params')['controller'], $allowedController)) {
//            $lang = $this->getRequest()->getParam('lang');
//            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index', 'lang' => $lang]);
//        }

        return parent::beforeFilter($event);
    }
}

<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\Routing\Router;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');


        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }


    protected function customUrlFilter(array &$params, \Cake\Http\ServerRequest $request)
    {
        if (!isset($params['controller']) && !isset($params['action'])) {
            if ($request->getParam('slug')) {
                $params = array_replace_recursive($params, [$request->getParam('slug')]);
            } else if ($request->getParam('controller') === 'Blogs' &&
                in_array($request->getParam('action'), ['topic', 'tag'])) {
                $params = array_replace_recursive($params, $request->getParam('pass'));

            }

            if (($query = $request->getQueryParams()) && !isset($params['?'])) {
                //$params['?'] = $query;
            }
        }

    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        Router::addUrlFilter(function (array $params, \Cake\Http\ServerRequest $request) {
            if ($request->getParam('lang') && !isset($params['lang'])) {
                $params['lang'] = $request->getParam('lang');
            }

            $this->customUrlFilter($params, $request);
            return $params;
        });

        if ($lang = $this->request->getParam('lang')) {
            I18n::setLocale($lang);
        } else {
            $languages = Configure::read('App.Languages');
            foreach($languages as $lang => $value) {
                if (isset($value['default']) && $value['default'] == true) {
                    I18n::setLocale($lang);
                    break;
                }
            }
        }
    }
}

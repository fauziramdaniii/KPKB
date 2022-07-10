<?php

use Cake\Core\Configure;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\Http\Middleware\CsrfProtectionMiddleware;

$languages = Configure::read('App.Languages');

foreach($languages as $lang => $val) {
    Router::scope('/' . (isset($val['default']) ? '' : $lang), ['lang' => $lang], function (RouteBuilder $routes) {
        $routes->plugin(
            'Member',
            ['path' => '/member'],
            function (RouteBuilder $routes) {
                $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware());
                $routes->applyMiddleware('csrf');
                $routes->connect('/', ['controller' => 'Dashboard']);
                $routes->fallbacks(DashedRoute::class);
            }
        );
    });

}


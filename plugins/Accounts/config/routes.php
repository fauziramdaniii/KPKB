<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Accounts\Middleware\CorsMiddleware;

Router::plugin(
    'Accounts',
    ['path' => '/accounts'],
    function (RouteBuilder $routes) {
        $routes->registerMiddleware('cors', new CorsMiddleware());
        $routes->applyMiddleware('cors');
        $routes->fallbacks(DashedRoute::class);
    }
);

<?php

use App\Routing\Router;
use App\Routing\Request;

Router::get('category/(.*)', static function (Request $request) {
    $controller = new \App\Controller\Store\HomeController();
    $controller->products($request->params[0]);
});


Router::get('search/', static function () {
    $controller = new \App\Controller\Store\HomeController();
    $controller->products();
});

Router::get('shop/', static function () {
    $controller = new \App\Controller\Store\HomeController();
    $controller->products();
});


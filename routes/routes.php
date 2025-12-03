<?php

use App\Routing\Router;

Router::get(BASE_PATH, static function () {
    $controller = new \App\Controller\Store\HomeController();
    $controller->index();
});
require_once 'auth.php';
require_once 'products.php';
require_once 'cart.php';
require_once 'account.php';

Router::post('state-locals', static function () {
    $controller = new \App\Controller\Store\HomeController();
    echo $controller->getStateLocalsSelect($_POST['state']);
    die();
});
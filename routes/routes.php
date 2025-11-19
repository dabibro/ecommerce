<?php

use App\Routing\Router;

Router::get(BASE_PATH, static function () {
    $controller = new \App\Controller\Store\HomeController();
    $controller->index();
});
require_once 'auth.php';
require_once 'products.php';
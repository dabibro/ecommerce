<?php

use App\Routing\Router;

$path = "account/";

Router::get($path . 'orders/', static function () {
    $controllers = new \App\Controller\Store\AccountController();
    $controllers->orders();
    die();
});
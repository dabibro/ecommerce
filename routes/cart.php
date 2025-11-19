<?php

use App\Routing\Router;
use App\Routing\Request;

Router::get('cart', static function () {
    $controller = new \App\Controller\Store\HomeController();
    $controller->cart();
    die();
});

Router::post('cart/add', static function (Request $request) {
    $controller = new \App\Controller\Store\CartController();
    $controller->addItem();
    die();
});

Router::post('cart/remove', static function (Request $request) {
    $controller = new \App\Controller\Store\CartController();
    $controller->removeItem();
    die();
});

Router::post('cart/update', static function (Request $request) {
    $controller = new \App\Controller\Store\CartController();
    $controller->updateQty();
    die();
});

Router::post('cart/empty', static function (Request $request) {
});

Router::post('cart/submit', static function (Request $request) {
    $controller = new \App\Controller\Store\HomeController();
    $controller->cart_to_database();
});
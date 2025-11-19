<?php

use App\Routing\Router;
use App\Routing\Request;

Router::get('auth/register', static function () {
    $controller = new \App\Controller\Store\AuthController();
    $controller->register();
});

Router::post('auth/register', static function () {
    $controller = new \App\Controller\Store\AuthController();
    $controller->doRegister();
});

Router::get('auth/register-success', static function () {
    $controller = new \App\Controller\Store\AuthController();
    $controller->register_success();
});


Router::get('auth/login', static function () {
    $controller = new \App\Controller\Store\AuthController();
    $controller->login();
});

Router::post('auth/login', static function () {
    $controller = new \App\Controller\Store\AuthController();
    $controller->doLogin();
});

Router::get('auth/forgot-password', static function () {
    $controller = new \App\Controller\Store\AuthController();
    $controller->forgot_password();
});

Router::post('auth/password-recovery', static function () {
    $controller = new \App\Controller\Store\AuthController();
    $controller->doForgotPassword();
});

Router::get('auth/password-reset/(.*)', static function (Request $request) {
    $controller = new \App\Controller\Store\AuthController();
    $controller->password_reset($request->params[0]);
});

Router::post('auth/password-reset', static function () {
    $controller = new \App\Controller\Store\AuthController();
    $controller->change_password();
});

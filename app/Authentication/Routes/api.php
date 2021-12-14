<?php

use DavorMinchorov\Authentication\Api\V1\Controllers\LoginController;
use DavorMinchorov\Authentication\Api\V1\Controllers\LogoutController;

/* @var \Illuminate\Routing\Router $router */

$router->post(uri: '/login', action: [LoginController::class, '__invoke'])
       ->name(name: 'login');
$router->post(uri: '/logout', action: [LogoutController::class, '__invoke'])
       ->name(name: 'logout')
       ->middleware(middleware: 'auth:sanctum');

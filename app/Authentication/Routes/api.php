<?php

use DavorMinchorov\Authentication\Api\V1\Controllers\LoginController;
use DavorMinchorov\Authentication\Api\V1\Controllers\LogoutController;

$this->router->post('/login', [LoginController::class, '__invoke'])->name('login');
$this->router->post('/logout', [LogoutController::class, '__invoke'])->name('logout')->middleware('auth:sanctum');

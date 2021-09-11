<?php

/** @var \Illuminate\Routing\Router $router */

use DavorMinchorov\Contact\Api\V1\Controllers\ContactController;

$router->post('/', [ContactController::class, '__invoke']);

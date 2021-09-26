<?php

/** @var \Illuminate\Routing\Router $router */

use DavorMinchorov\Contact\Api\V1\Controllers\ContactController;

$router->post(uri: '/', action: [ContactController::class, '__invoke']);

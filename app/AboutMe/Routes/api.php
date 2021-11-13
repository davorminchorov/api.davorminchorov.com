<?php

/** @var \Illuminate\Routing\Router $router */

use DavorMinchorov\AboutMe\Api\V1\Controllers\AboutMeController;

$router->get(uri: '/', action: [AboutMeController::class, '__invoke']);

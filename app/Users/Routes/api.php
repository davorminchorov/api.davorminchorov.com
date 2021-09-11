<?php

/** @var \Illuminate\Routing\Router $router */

$router->get('/', function () {
    return response()->json([
        'version' => 1,
        'name' => 'Davor Minchorov API',
        'module' => 'Users',
    ]);
});

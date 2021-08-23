<?php

$this->router->get('/', function () {
    return response()->json([
        'version' => 1,
        'name' => 'Davor Minchorov API',
        'module' => 'Authentication'
    ]);
});

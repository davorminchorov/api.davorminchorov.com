<?php

return [
    'framework' => [
        'name' => 'Framework',
        'api_routes_path' => 'app/Framework/Routes/api.php',
        'api_prefix' => 'v1',
        'api_route_name_prefix' => 'v1.framework.',
        'api_middleware' => ['api'],
        'api_namespace' => 'DavorMinchorov\Framework\Api\V1\Controllers',
    ],
    'authentication' => [
        'name' => 'Authentication',
        'api_routes_path' => 'app/Authentication/Routes/api.php',
        'api_prefix' => 'v1/authentication',
        'api_route_name_prefix' => 'v1.authentication.',
        'api_middleware' => ['api'],
        'api_namespace' => 'DavorMinchorov\Authentication\Api\V1\Controllers',
    ],
    'users' => [
        'name' => 'Users',
        'api_routes_path' => 'app/Users/Routes/api.php',
        'api_prefix' => 'v1/users',
        'api_route_name_prefix' => 'v1.users.',
        'api_middleware' => ['api'],
        'api_namespace' => 'DavorMinchorov\Users\Api\V1\Controllers',
    ],

    'personalAccessTokens' => [
        'name' => 'PersonalAccessTokens',
        'api_routes_path' => 'app/PersonalAccessTokens/Routes/api.php',
        'api_prefix' => 'v1/personalAccessTokens',
        'api_route_name_prefix' => 'v1.personalAccessTokens.',
        'api_middleware' => ['api'],
        'api_namespace' => 'DavorMinchorov\PersonalAccessTokens\Api\V1\Controllers',
    ],

    'contact' => [
        'name' => 'Contact',
        'api_routes_path' => 'app/Contact/Routes/api.php',
        'api_prefix' => 'v1/contact',
        'api_route_name_prefix' => 'v1.contact',
        'api_middleware' => ['api'],
        'api_namespace' => 'DavorMinchorov\Contact\Api\V1\Controllers',
    ],

    'blog' => [
        'name' => 'Blog',
        'api_routes_path' => 'app/Blog/Routes/api.php',
        'api_prefix' => 'v1/blog',
        'api_route_name_prefix' => 'v1.blog.',
        'api_middleware' => ['api'],
        'api_namespace' => 'DavorMinchorov\Blog\Api\V1\Controllers',
    ],
];

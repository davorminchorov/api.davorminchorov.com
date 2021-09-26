<?php

/** @var \Illuminate\Routing\Router $router */

use DavorMinchorov\Blog\Api\V1\Controllers\BlogPostsController;
use DavorMinchorov\Blog\Api\V1\Controllers\SingleBlogPostController;

$router->get(uri: '/posts', action: [BlogPostsController::class, '__invoke'])
       ->name(name: 'posts');

$router->get(uri: '/posts/{slug}', action: [SingleBlogPostController::class, '__invoke'])
       ->where(name: 'slug', expression: '([a-z0-9]+-)*[a-z0-9]+')
       ->name(name: 'single-post');

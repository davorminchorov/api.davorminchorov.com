<?php

/** @var \Illuminate\Routing\Router $router */

use DavorMinchorov\Blog\Api\V1\Controllers\BlogPostsController;
use DavorMinchorov\Blog\Api\V1\Controllers\BlogTagController;
use DavorMinchorov\Blog\Api\V1\Controllers\SingleBlogPostController;
use DavorMinchorov\Blog\Api\V1\Controllers\SingleBlogTagController;

$router->get(uri: '/posts', action: [BlogPostsController::class, '__invoke'])
       ->name(name: 'posts');

$router->get(uri: '/posts/{slug}', action: [SingleBlogPostController::class, '__invoke'])
       ->where(name: 'slug', expression: '([a-z0-9]+-)*[a-z0-9]+')
       ->name(name: 'single-post');


$router->get(uri: '/tags', action: [BlogTagController::class, '__invoke'])
       ->name(name: 'tags');

$router->get(uri: '/tags/{slug}', action: [SingleBlogTagController::class, '__invoke'])
    ->where(name: 'slug', expression: '([a-z0-9]+-)*[a-z0-9]+')
    ->name(name: 'single-tag');

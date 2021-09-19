<?php

/** @var \Illuminate\Routing\Router $router */

use DavorMinchorov\Blog\Api\V1\Controllers\BlogPostsController;

$router->get('/posts', [BlogPostsController::class, '__invoke'])->name('posts');

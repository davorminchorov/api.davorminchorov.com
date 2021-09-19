<?php

namespace DavorMinchorov\Blog\Api\V1\Controllers;

use DavorMinchorov\Blog\Actions\BlogPostsAction;
use DavorMinchorov\Blog\Api\V1\ApiResources\BlogPostJsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BlogPostsController
{
    /**
     * BlogController constructor.
     *
     * @param BlogPostsAction $blogPostsAction
     */
    public function __construct(private BlogPostsAction $blogPostsAction)
    {
        //
    }

    /**
     * Gets a list of published blog posts.
     */
    public function __invoke(): AnonymousResourceCollection
    {
        return BlogPostJsonResource::collection(resource: ($this->blogPostsAction)());
    }
}

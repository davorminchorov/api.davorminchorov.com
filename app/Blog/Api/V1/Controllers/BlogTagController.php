<?php

namespace DavorMinchorov\Blog\Api\V1\Controllers;

use DavorMinchorov\Blog\Actions\GetBlogTagsAction;
use DavorMinchorov\Blog\Api\V1\ApiResources\BlogPostJsonResource;
use DavorMinchorov\Blog\Api\V1\ApiResources\BlogTagJsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BlogTagController
{
    /**
     * BlogTagsController constructor.
     *
     * @param GetBlogTagsAction $getBlogTagsAction
     */
    public function __construct(private GetBlogTagsAction $getBlogTagsAction)
    {
        //
    }

    /**
     * Gets a list of published blog posts.
     */
    public function __invoke(): AnonymousResourceCollection
    {
        return BlogTagJsonResource::collection(
            resource: ($this->getBlogTagsAction)()
        );
    }
}

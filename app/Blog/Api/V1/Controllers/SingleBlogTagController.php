<?php

namespace DavorMinchorov\Blog\Api\V1\Controllers;

use DavorMinchorov\Blog\Actions\GetPublishedBlogPostsByTagSlugAction;
use DavorMinchorov\Blog\Api\V1\ApiResources\BlogPostJsonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleBlogTagController
{
    /**
     * BlogController constructor.
     *
     * @param GetPublishedBlogPostsByTagSlugAction $getPublishedBlogPostsByTagSlugAction
     */
    public function __construct(private GetPublishedBlogPostsByTagSlugAction $getPublishedBlogPostsByTagSlugAction)
    {
        //
    }

    /**
     * Gets published blog posts by a specific tag slug.
     */
    public function __invoke(string $slug): JsonResource
    {
        return BlogPostJsonResource::collection(
            resource: ($this->getPublishedBlogPostsByTagSlugAction)($slug)
        );
    }
}

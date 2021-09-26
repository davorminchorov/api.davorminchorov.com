<?php

namespace DavorMinchorov\Blog\Api\V1\Controllers;

use DavorMinchorov\Blog\Actions\GetSingleBlogPostBySlugAction;
use DavorMinchorov\Blog\Api\V1\ApiResources\BlogPostJsonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleBlogPostController
{
    /**
     * BlogController constructor.
     *
     * @param GetSingleBlogPostBySlugAction $getSingleBlogPostBySlugAction
     */
    public function __construct(private GetSingleBlogPostBySlugAction $getSingleBlogPostBySlugAction)
    {
        //
    }

    /**
     * Gets specific published blog post by slug.
     */
    public function __invoke(string $slug): JsonResource
    {
        return BlogPostJsonResource::make(
            resource: ($this->getSingleBlogPostBySlugAction)($slug)
        );
    }
}

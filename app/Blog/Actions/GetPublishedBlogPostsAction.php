<?php

namespace DavorMinchorov\Blog\Actions;

use DavorMinchorov\Blog\Queries\GetPublishedBlogPostsQuery;
use Illuminate\Database\Eloquent\Collection;

class GetPublishedBlogPostsAction
{
    /**
     * BlogPostsAction constructor.
     * @param GetPublishedBlogPostsQuery $getPublishedBlogPostsQuery
     */
    public function __construct(private GetPublishedBlogPostsQuery $getPublishedBlogPostsQuery)
    {
        //
    }

    /**
     * Gets a list of published blog posts.
     */
    public function __invoke(): Collection
    {
        return ($this->getPublishedBlogPostsQuery)();
    }
}

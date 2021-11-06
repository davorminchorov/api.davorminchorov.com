<?php

namespace DavorMinchorov\Blog\Actions;

use DavorMinchorov\Blog\Queries\GetPublishedBlogPostsQuery;
use Illuminate\Database\Eloquent\Collection;

class GetPublishedBlogPostsAction
{
    /**
     * GetPublishedBlogPostsAction constructor.
     *
     * @param GetPublishedBlogPostsQuery $getPublishedBlogPostsQuery
     */
    public function __construct(private GetPublishedBlogPostsQuery $getPublishedBlogPostsQuery)
    {
        //
    }

    /**
     * Gets a collection of published blog posts.
     *
     * @return Collection
     */
    public function __invoke(): Collection
    {
        return ($this->getPublishedBlogPostsQuery)();
    }
}

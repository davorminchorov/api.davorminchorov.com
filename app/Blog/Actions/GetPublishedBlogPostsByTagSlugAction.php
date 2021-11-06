<?php

namespace DavorMinchorov\Blog\Actions;

use DavorMinchorov\Blog\Queries\GetPublishedBlogPostsByTagSlugQuery;
use Illuminate\Database\Eloquent\Collection;

class GetPublishedBlogPostsByTagSlugAction
{
    /**
     * GetPublishedBlogPostsByTagSlugAction constructor.
     * @param GetPublishedBlogPostsByTagSlugQuery $getPublishedBlogPostsByTagSlugQuery
     */
    public function __construct(private GetPublishedBlogPostsByTagSlugQuery $getPublishedBlogPostsByTagSlugQuery)
    {
        //
    }

    /**
     * Gets a collection of published blog posts by a specific blog tag slug.
     *
     * @param string $blogTagSlug
     *
     * @return Collection
     */
    public function __invoke(string $blogTagSlug): Collection
    {
        return ($this->getPublishedBlogPostsByTagSlugQuery)($blogTagSlug);
    }
}

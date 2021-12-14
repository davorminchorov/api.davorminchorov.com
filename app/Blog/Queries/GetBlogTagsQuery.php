<?php

namespace DavorMinchorov\Blog\Queries;

use DavorMinchorov\Blog\Models\BlogTag;
use Illuminate\Database\Eloquent\Collection;

class GetBlogTagsQuery
{
    /**
     * GetBlogTagsQuery constructor.
     *
     * @param BlogTag $blogTag
     */
    public function __construct(private BlogTag $blogTag)
    {
    }

    /**
     * Gets a collection of blog tags.
     *
     * @return Collection
     */
    public function __invoke(): Collection
    {
        return $this->blogTag->newQuery()->get();
    }
}

<?php

namespace DavorMinchorov\Blog\Actions;

use DavorMinchorov\Blog\Queries\GetBlogTagsQuery;
use Illuminate\Database\Eloquent\Collection;

class GetBlogTagsAction
{
    /**
     * GetBlogTagsAction constructor.
     *
     * @param GetBlogTagsQuery $getBlogTagsQuery
     */
    public function __construct(private GetBlogTagsQuery $getBlogTagsQuery)
    {
        //
    }

    /**
     * Gets a list of blog tags.
     */
    public function __invoke(): Collection
    {
        return ($this->getBlogTagsQuery)();
    }
}

<?php

namespace DavorMinchorov\Blog\Queries;

use DavorMinchorov\Blog\Models\BlogPost;
use Illuminate\Database\Eloquent\Collection;

class GetPublishedBlogPostsQuery
{
    /**
     * GetPublishedBlogPostsQuery constructor.
     *
     * @param BlogPost $blogPost
     */
    public function __construct(private BlogPost $blogPost)
    {

    }

    /**
     * Gets a collection of published blog posts.
     *
     * @return Collection
     */
    public function __invoke(): Collection
    {
        return $this->blogPost->newQuery()->published()->latest('created_at')->get();
    }
}

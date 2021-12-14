<?php

namespace DavorMinchorov\Blog\Queries;

use DavorMinchorov\Blog\Models\BlogPost;
use Illuminate\Database\Eloquent\Collection;

class GetPublishedBlogPostBySlugQuery
{
    /**
     * GetPublishedBlogPostBySlugQuery constructor.
     *
     * @param BlogPost $blogPost
     */
    public function __construct(private BlogPost $blogPost)
    {
    }

    /**
     * Gets a specific published blog post by slug.
     *
     * @param string $slug
     *
     * @return BlogPost
     */
    public function __invoke(string $slug): BlogPost
    {
        $blogPost = $this->blogPost
            ->newQuery()
            ->with(relations: ['blogTags'])
            ->published()
            ->where(column: 'slug', operator: '=', value: $slug)
            ->first();

        /* @var BlogPost|null $blogPost */
        return $blogPost ?? $this->blogPost;
    }
}

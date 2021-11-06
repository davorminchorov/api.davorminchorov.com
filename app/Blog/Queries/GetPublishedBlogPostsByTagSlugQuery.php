<?php

namespace DavorMinchorov\Blog\Queries;

use DavorMinchorov\Blog\Models\BlogPost;
use Illuminate\Database\Eloquent\Collection;

class GetPublishedBlogPostsByTagSlugQuery
{
    /**
     * GetPublishedBlogPostsByTagSlugQuery constructor.
     *
     * @param BlogPost $blogPost
     */
    public function __construct(private BlogPost $blogPost)
    {

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
        return $this->blogPost->newQuery()
            ->with(relations: ['blogTags'])
            ->published()
            ->whereRelation(relation: 'blogTags', column: 'slug', operator: '=', value: $blogTagSlug)
            ->latest('published_at')
            ->get();
    }
}

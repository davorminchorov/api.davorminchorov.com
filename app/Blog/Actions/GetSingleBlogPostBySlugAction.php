<?php

namespace DavorMinchorov\Blog\Actions;

use DavorMinchorov\Blog\Models\BlogPost;
use DavorMinchorov\Blog\Queries\GetPublishedBlogPostBySlugQuery;
use DavorMinchorov\Blog\Rules\ValidateBlogPostRule;

class GetSingleBlogPostBySlugAction
{
    /**
     * GetSingleBlogPostBySlugAction constructor.
     *
     * @param GetPublishedBlogPostBySlugQuery $getPublishedBlogPostBySlugQuery
     * @param ValidateBlogPostRule $validateBlogPostRule
     */
    public function __construct(
        private GetPublishedBlogPostBySlugQuery $getPublishedBlogPostBySlugQuery,
        private ValidateBlogPostRule $validateBlogPostRule
    ) {
        //
    }

    /**
     * Gets a specific published blog post by slug.
     */
    public function __invoke(string $slug): BlogPost
    {
        $blogPost = ($this->getPublishedBlogPostBySlugQuery)($slug);

        ($this->validateBlogPostRule)($blogPost);

        return $blogPost;
    }
}

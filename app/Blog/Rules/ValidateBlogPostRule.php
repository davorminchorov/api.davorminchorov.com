<?php

namespace DavorMinchorov\Blog\Rules;

use DavorMinchorov\Blog\Models\BlogPost;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ValidateBlogPostRule
{
    /**
     * Checks if the provided blog post exists.
     *
     * @param BlogPost $blogPost
     *
     * @return bool
     */
    public function __invoke(BlogPost $blogPost): bool
    {
        if ($blogPost->getKey()) {
            return true;
        }

        throw new ModelNotFoundException();
    }
}

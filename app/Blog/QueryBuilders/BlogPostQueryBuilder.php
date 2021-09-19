<?php

namespace DavorMinchorov\Blog\QueryBuilders;

use DavorMinchorov\Blog\Enums\BlogPostStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class BlogPostQueryBuilder extends Builder
{
    /**
     * @return self
     */
    public function published(): self
    {
        return $this->where('status', BlogPostStatus::PUBLISHED)
                    ->where('published_at', '<', Carbon::now());
    }

    /**
     * @return self
     */
    public function draft(): self
    {
        return $this->where('status', BlogPostStatus::DRAFT);
    }

    /**
     * @return self
     */
    public function scheduled(): self
    {
        return $this->where('status', BlogPostStatus::SCHEDULED)
                    ->where('published_at', '>', Carbon::now());
    }
}

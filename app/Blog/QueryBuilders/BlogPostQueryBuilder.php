<?php

namespace DavorMinchorov\Blog\QueryBuilders;

use DavorMinchorov\Blog\Enums\BlogPostStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class BlogPostQueryBuilder extends Builder
{
    /**
     * Filters the blog post(s) which have the published status.
     *
     * @return self
     */
    public function published(): self
    {
        return $this->where(column: 'status', operator: '=', value: BlogPostStatus::PUBLISHED)
                    ->where(column: 'published_at', operator: '<', value: Carbon::now());
    }

    /**
     * Filters the blog post(s) which have the draft status.
     *
     * @return self
     */
    public function draft(): self
    {
        return $this->where(column: 'status', operator: '=', value: BlogPostStatus::DRAFT);
    }

    /**
     * Filters the blog post(s) which have the scheduled status.
     *
     * @return self
     */
    public function scheduled(): self
    {
        return $this->where(column: 'status', operator: '=', value: BlogPostStatus::SCHEDULED)
                    ->where(column: 'published_at', operator: '>', value: Carbon::now());
    }

    /**
     * Filters the blog post(s) which have the archived status.
     *
     * @return self
     */
    public function archived(): self
    {
        return $this->where(column: 'status', operator: '=', value: BlogPostStatus::ARCHIVED)
            ->where(column: 'published_at', operator: '<', value: Carbon::now());
    }

    /**
     * Filters the blog post(s) which have the hidden status.
     *
     * @return self
     */
    public function hidden(): self
    {
        return $this->where(column: 'status', operator: '=', value: BlogPostStatus::HIDDEN);
    }
}

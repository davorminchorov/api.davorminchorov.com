<?php

namespace DavorMinchorov\Blog\Models;

use DavorMinchorov\Blog\Factories\BlogPostFactory;
use DavorMinchorov\Blog\QueryBuilders\BlogPostQueryBuilder;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * DavorMinchorov\Blog\Models\BlogPost
 *
 * @method static BlogPostFactory factory(...$parameters)
 * @method static BlogPostQueryBuilder|BlogPost newModelQuery()
 * @method static BlogPostQueryBuilder|BlogPost newQuery()
 * @method static BlogPostQueryBuilder|BlogPost query()
 * @method static BlogPostQueryBuilder|BlogPost scopeDraft()
 * @method static BlogPostQueryBuilder|BlogPost scopePublished()
 * @method static BlogPostQueryBuilder|BlogPost scopeScheduled()
 * @method static BlogPostQueryBuilder|BlogPost whereUuid($uuid, $uuidColumn = null)
 * @mixin Eloquent
 */
class BlogPost extends Model
{
    use HasFactory, GeneratesUuid;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => EfficientUuid::class,
        'published_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'user_uuid',
        'title',
        'slug',
        'excerpt',
        'content',
        'status',
        'published_at',
    ];

    /**
     * Get a new query builder that doesn't have any global scopes or eager loading.
     *
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return BlogPostQueryBuilder
     */
    public function newEloquentBuilder($query): Builder
    {
        return new BlogPostQueryBuilder(query: $query);
    }
}

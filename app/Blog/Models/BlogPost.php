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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
 * @property mixed $uuid
 * @property mixed $user_uuid
 * @property string $title
 * @property string $slug
 * @property string $excerpt
 * @property string $content
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\DavorMinchorov\Blog\Models\BlogTag[] $blogTags
 * @property-read int|null $blog_tags_count
 * @method static BlogPostQueryBuilder|BlogPost archived()
 * @method static BlogPostQueryBuilder|BlogPost draft()
 * @method static BlogPostQueryBuilder|BlogPost hidden()
 * @method static BlogPostQueryBuilder|BlogPost published()
 * @method static BlogPostQueryBuilder|BlogPost scheduled()
 * @method static BlogPostQueryBuilder|BlogPost whereContent($value)
 * @method static BlogPostQueryBuilder|BlogPost whereCreatedAt($value)
 * @method static BlogPostQueryBuilder|BlogPost whereExcerpt($value)
 * @method static BlogPostQueryBuilder|BlogPost wherePublishedAt($value)
 * @method static BlogPostQueryBuilder|BlogPost whereSlug($value)
 * @method static BlogPostQueryBuilder|BlogPost whereStatus($value)
 * @method static BlogPostQueryBuilder|BlogPost whereTitle($value)
 * @method static BlogPostQueryBuilder|BlogPost whereUpdatedAt($value)
 * @method static BlogPostQueryBuilder|BlogPost whereUserUuid($value)
 * @property int $id
 * @property int $user_id
 * @method static BlogPostQueryBuilder|BlogPost whereId($value)
 * @method static BlogPostQueryBuilder|BlogPost whereUserId($value)
 */
class BlogPost extends Model
{
    use HasFactory, GeneratesUuid;

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
        'user_id',
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

    /**
     * The many-to-many relationship between the blog posts and blog tags tables.
     *
     * @return BelongsToMany
     */
    public function blogTags(): BelongsToMany
    {
        return $this->belongsToMany(related: BlogTag::class, table: 'blog_post_tags');
    }
}

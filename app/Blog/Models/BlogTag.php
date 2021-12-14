<?php

namespace DavorMinchorov\Blog\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * DavorMinchorov\Blog\Models\BlogTag.
 *
 * @property mixed $uuid
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\DavorMinchorov\Blog\Models\BlogPost[] $blogPosts
 * @property-read int|null $blog_posts_count
 * @method static \DavorMinchorov\Blog\Factories\BlogTagFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereUuid($value)
 * @mixin \Eloquent
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereId($value)
 */
class BlogTag extends Model
{
    use HasFactory, GeneratesUuid;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'slug',
    ];

    /**
     * The many-to-many relationship between the blog posts and blog tags tables.
     *
     * @return BelongsToMany
     */
    public function blogPosts(): BelongsToMany
    {
        return $this->belongsToMany(related: BlogPost::class, table: 'blog_post_tags');
    }
}

<?php

namespace DavorMinchorov\AboutMe\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * DavorMinchorov\AboutMe\Models\AboutMe
 *
 * @method static \DavorMinchorov\AboutMe\Factories\AboutMeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutMe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutMe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutMe query()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutMe whereUuid($uuid, $uuidColumn = null)
 * @mixin \Eloquent
 */
class AboutMe extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'about_me';

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
        'content',
    ];
}

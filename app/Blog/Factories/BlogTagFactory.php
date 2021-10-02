<?php

namespace DavorMinchorov\Blog\Factories;

use DavorMinchorov\Blog\Models\BlogTag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->word(),
            'slug' => Str::slug($name),
        ];
    }
}

<?php

namespace DavorMinchorov\Blog\Factories;

use DavorMinchorov\Blog\Enums\BlogPostStatus;
use DavorMinchorov\Blog\Models\BlogPost;
use DavorMinchorov\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->sentence(5),
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraph(10),
            'excerpt' => $this->faker->paragraph(3),
        ];
    }

    /**
     * Indicate that the model's status should be draft.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function draft(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => null,
                'status' => BlogPostStatus::DRAFT,
            ];
        });
    }

    /**
     * Indicate that the model's status should be scheduled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function published(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => Carbon::now()->subDays(3),
                'status' => BlogPostStatus::PUBLISHED,
            ];
        });
    }

    /**
     * Indicate that the model's status should be scheduled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function scheduled(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => Carbon::now()->addDays(3),
                'status' => BlogPostStatus::SCHEDULED,
            ];
        });
    }

    /**
     * Indicate that the model's status should be archived.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function archived(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => Carbon::now()->subDays(3),
                'status' => BlogPostStatus::ARCHIVED,
            ];
        });
    }
}

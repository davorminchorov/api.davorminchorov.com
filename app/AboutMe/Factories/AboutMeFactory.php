<?php

namespace DavorMinchorov\AboutMe\Factories;

use DavorMinchorov\AboutMe\Models\AboutMe;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutMeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = AboutMe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->paragraphs(nb: 10, asText: true),
        ];
    }
}

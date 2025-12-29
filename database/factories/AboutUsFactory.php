<?php

namespace Database\Factories;

use App\Models\AboutUs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AboutUs>
 */
class AboutUsFactory extends Factory
{
    protected $model = AboutUs::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->paragraphs(5, true),
            'image' => 'https://placehold.co/1200x800/0891b2/ffffff?text=About+Us',
            'meta' => [
                'mission' => $this->faker->sentence(),
                'vision' => $this->faker->sentence(),
            ],
        ];
    }
}

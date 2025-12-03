<?php

namespace Database\Factories;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Portfolio>
 */
class PortfolioFactory extends Factory
{
    protected $model = Portfolio::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(3);
        return [
            'title' => $title,
            'slug' => Str::slug($title.'-'.$this->faker->unique()->uuid()),
            'excerpt' => $this->faker->sentence(15),
            'description' => $this->faker->paragraphs(4, true),
            'image' => $this->faker->imageUrl(1200, 800, 'portfolio', true),
            'gallery' => [
                $this->faker->imageUrl(1200, 800, 'portfolio', true),
                $this->faker->imageUrl(1200, 800, 'portfolio', true),
            ],
            'link' => $this->faker->url(),
            'category' => $this->faker->word(),
            'client' => $this->faker->company(),
            'completed_at' => $this->faker->date(),
            'is_published' => $this->faker->boolean(90),
        ];
    }
}

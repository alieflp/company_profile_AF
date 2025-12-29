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
            'image' => 'https://placehold.co/1200x800/1e40af/ffffff?text=Portfolio',
            'gallery' => [
                'https://placehold.co/1200x800/1e40af/ffffff?text=Gallery+1',
                'https://placehold.co/1200x800/1e40af/ffffff?text=Gallery+2',
            ],
            'link' => $this->faker->url(),
            'category' => $this->faker->randomElement(['Web Development', 'Mobile App', 'UI/UX Design', 'Software']),
            'client' => $this->faker->company(),
            'completed_at' => $this->faker->date(),
            'tech_stack' => $this->faker->randomElement(['Laravel, Vue.js, MySQL', 'React Native, Firebase', 'Figma, Adobe XD', 'PHP, JavaScript, Tailwind CSS']),
            'is_published' => $this->faker->boolean(90),
        ];
    }
}

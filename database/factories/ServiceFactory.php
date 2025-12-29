<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(3);
        return [
            'title' => $title,
            'slug' => Str::slug($title.'-'.$this->faker->unique()->uuid()),
            'excerpt' => $this->faker->sentence(10),
            'description' => $this->faker->paragraphs(3, true),
            'icon' => 'fa-solid fa-gear',
            'image' => 'https://placehold.co/800x600/2563eb/ffffff?text=Service',
            'is_active' => $this->faker->boolean(90),
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Setting>
 */
class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition(): array
    {
        $key = $this->faker->unique()->slug(2);
        $type = $this->faker->randomElement(['string', 'text', 'json']);

        return [
            'key' => $key,
            'value' => $type === 'json'
                ? json_encode(['example' => $this->faker->word()])
                : ($type === 'text' ? $this->faker->paragraphs(2, true) : $this->faker->sentence()),
            'type' => $type,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<BlogPost>
 */
class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(5);
        $isPublished = $this->faker->boolean(70);
        return [
            'title' => $title,
            'slug' => Str::slug($title.'-'.$this->faker->unique()->uuid()),
            'excerpt' => $this->faker->paragraph(),
            'content' => $this->faker->paragraphs(6, true),
            'cover_image' => $this->faker->imageUrl(1280, 720, 'blog', true),
            'author' => $this->faker->name(),
            'published_at' => $isPublished ? $this->faker->dateTimeBetween('-30 days', 'now') : null,
            'is_published' => $isPublished,
            'tags' => $this->faker->randomElements([$this->faker->word(), $this->faker->word(), $this->faker->word()], rand(1, 3)),
        ];
    }
}

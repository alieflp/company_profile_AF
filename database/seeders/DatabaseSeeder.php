<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Core seeders
        $this->call([
            AdminUserSeeder::class,
            SettingsSeeder::class,
            AboutUsSeeder::class,
            ServicesSeeder::class,
            PortfoliosSeeder::class,
            TestimonialsSeeder::class,
            ContactMessagesSeeder::class,
        ]);

        // Optional blog
        if (config('features.blog')) {
            $this->call([
                BlogPostsSeeder::class,
            ]);
        }
    }
}

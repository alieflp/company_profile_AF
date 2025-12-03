<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfoliosSeeder extends Seeder
{
    public function run(): void
    {
        Portfolio::factory()->count(6)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessagesSeeder extends Seeder
{
    public function run(): void
    {
        ContactMessage::factory()->count(3)->create();
    }
}

<?php

namespace Database\Factories;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactMessage>
 */
class ContactMessageFactory extends Factory
{
    protected $model = ContactMessage::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement(['new', 'read', 'responded', 'archived']);
        $isRead = in_array($status, ['read', 'responded', 'archived'], true);
        $readAt = $isRead ? $this->faker->dateTimeBetween('-10 days', 'now') : null;
        $respondedAt = $status === 'responded' ? $this->faker->dateTimeBetween($readAt ?? '-10 days', 'now') : null;

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->optional()->e164PhoneNumber(),
            'subject' => $this->faker->optional()->sentence(4),
            'message' => $this->faker->paragraphs(3, true),
            'status' => $status,
            'is_read' => $isRead,
            'read_at' => $readAt,
            'responded_at' => $respondedAt,
            'response_notes' => $respondedAt ? $this->faker->sentence() : null,
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
        ];
    }
}

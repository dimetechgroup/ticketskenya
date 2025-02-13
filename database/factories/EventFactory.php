<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'venue' => $this->faker->city,
            'location' => $this->faker->randomElement(['online', 'offline']),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'status' => $this->faker->randomElement(['pending', 'approved', 'cancelled', 'completed']),
            'image' => 'https://via.placeholder.com/800x400',
            'user_id' => User::all()->random()->id,
            'meeting_link' => $this->faker->url,
            'currency' => $this->faker->randomElement(['KES', 'USD']),
            'contact_number' => $this->faker->phoneNumber,
            'contact_email' => $this->faker->safeEmail,
            'processing_fee' => $this->faker->randomFloat(2, 0, 100),
            'is_private' => $this->faker->boolean,
        ];
    }
}

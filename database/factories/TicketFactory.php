<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $event  = Event::all()->random();
        return [
            'event_id' => $event->id,
            'name' => $this->faker->sentence(3),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'discount' => $this->faker->numberBetween(0, 50),
            'currency' => $event->currency,
            'quantity' => $this->faker->numberBetween(50, 500),
            'sold_quantity' => $this->faker->numberBetween(0, 50),
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['active', 'sold out', 'cancelled']),
            'max_per_user' => $this->faker->numberBetween(1, 10),
            'min_per_user' => $this->faker->numberBetween(1, 5),
            'promo_code' => $this->faker->optional()->bothify('PROMO-####')
        ];
    }
}

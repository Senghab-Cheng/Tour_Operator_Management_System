<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = ['img/destination-1.jpg', 'img/destination-2.', 'img/destination-3.jpg', 'img/destination-4.jpg'];

        return [
            'name' => fake()->unique()->city(),
            'discount' => fake()->optional()->randomElement(['20% OFF', '25% OFF', '30% OFF', '35% OFF']),
            'image_path' => fake()->randomElement($images),
        ];
    }
}

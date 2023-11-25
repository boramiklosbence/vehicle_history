<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BrowsingHistory>
 */
class BrowsingHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // * keresett rendszám
        // * keresés ideje

        return [
            'searched_registration_number' => \App\Models\Vehicle::all()->random()->registration_number,
            'searched_at' => fake()->date(),
        ];
    }
}

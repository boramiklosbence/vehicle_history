<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // * rendszám
        // * márka
        // * típus
        // * gyártási év
        // * kép

        return [
            'registration_number' => "ABC-123",
            'brand' => "Suzuki",
            'type' => "Swift",
            'year' => 2010,
            'image' => "https://www.autonavigator.hu/wp-content/uploads/2019/10/2019-suzuki-swift-1-2-dualjet-shvs-4wd-1.jpg",
        ];
    }
}

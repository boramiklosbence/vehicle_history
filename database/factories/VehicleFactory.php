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
        // * rendszám (pl. ABC-123)
        // * márka (pl. Suzuki)
        // * típus (pl. E42, [A-Z]\d{2})
        // * gyártási év (pl. 2019)
        // * kép 

        return [
            'registration_number' => fake()->unique()->regexify('[A-Z]{3}-\d{3}'),
            'brand' => fake()->randomElement([ 'Toyota','Volkswagen','Ford','Honda','Suzuki','Nissan','Hyundai','Mercedes-Benz','BMW','Kia']),
            'type' => fake()->regexify('[A-Z]\d{2}'),
            'year' => fake()->year(),
            'image' => 'https://www.autonavigator.hu/wp-content/uploads/2019/10/2019-suzuki-swift-1-2-dualjet-shvs-4wd-1.jpg',
        ];
    }
}

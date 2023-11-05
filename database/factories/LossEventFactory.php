<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LossEvent>
 */
class LossEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // * helyszín
        // * időpont
        // * leírás

        return [
            'location' => "Budapest",
            'date' => "2021-01-01",
            'description' => "Description",
        ];
    }
}

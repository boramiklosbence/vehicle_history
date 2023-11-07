<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // * adminisztrátor-e (logikai)
        // * prémium felhasználó-e (logikai) - az adminisztrátorok automatikusan prémium felhasználók is, ezt többféleképpen is meg lehet oldani

        $randomAdminNumber = fake()->numberBetween(1, 4);
        $isAdmin = $randomAdminNumber === 1;

        $randomPremiumNumber = fake()->numberBetween(1, 4);
        $isPremium = $randomPremiumNumber === 2 || $isAdmin;

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => $isAdmin,
            'is_premium' => $isAdmin ? $isAdmin : $isPremium,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

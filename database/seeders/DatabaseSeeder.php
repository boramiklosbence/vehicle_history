<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create data
        $users = \App\Models\User::factory(10)->create();
        $vehicles = \App\Models\Vehicle::factory(10)->create();
        $loss_events = \App\Models\LossEvent::factory(10)->create();
        $browsing_histories = \App\Models\BrowsingHistory::factory(10)->create();

        // Manually create an admin and a premium user to always have at least one of each
        $users->push(\App\Models\User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => True,
            'is_premium' => True,
        ]));

        $users->push(\App\Models\User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => False,
            'is_premium' => True,
        ]));

        // Associate the users with the browsing histories
        foreach($browsing_histories as $browsing_history) {
            $browsing_history->user()->associate(\App\Models\User::all()->random())->save();
        }

        // Associate the vehicles with the loss events
        foreach($vehicles as $vehicle) {
            $vehicle->loss_events()->sync(
                $loss_events->random(
                    rand(1,$loss_events->count())
                )
            );
        }
    }
}

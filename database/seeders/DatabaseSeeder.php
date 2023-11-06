<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = \App\Models\User::factory(10)->create();
        $vehicles = \App\Models\Vehicle::factory(10)->create();
        $loss_events = \App\Models\LossEvent::factory(10)->create();
        $browsing_histories = \App\Models\BrowsingHistory::factory(10)->create();
    }
}

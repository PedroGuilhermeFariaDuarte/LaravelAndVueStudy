<?php

namespace Database\Seeders;

use App\Models\Drive;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $team = Team::factory()
            ->count(1)
            ->create();

        $users = User::factory()
            ->count(1)
            ->state([
                "team_id" => 1,
            ])
            ->create();

        $driver = Drive::factory()
            ->count(1)
            ->state([
                "team_id" => 1,
            ]);
    }
}

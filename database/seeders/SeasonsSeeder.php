<?php

namespace Database\Seeders;

use App\Models\Season;
use Database\Factories\SeasonFactory;
use Illuminate\Database\Seeder;

class SeasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Season::factory()
            ->count(20)
            ->create();
    }
}

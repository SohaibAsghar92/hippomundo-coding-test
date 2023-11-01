<?php

namespace Database\Seeders;

use App\Models\Phase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Phase::factory()
            ->count(5)
            ->sequence(
                ['name' => Phase::$BACKLOG],
                ['name' => Phase::$TODO],
                ['name' => Phase::$DOING],
                ['name' => Phase::$DONE],
                ['name' => Phase::$ARCHIVED],)
            ->create();
    }
}

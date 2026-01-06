<?php

namespace Database\Seeders;

use App\Models\Terapeut;
use Illuminate\Database\Seeder;

class TerapeutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Terapeut::factory()
            ->count(5)
            ->create();
    }
}

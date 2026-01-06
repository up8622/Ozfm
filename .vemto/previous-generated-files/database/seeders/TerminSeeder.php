<?php

namespace Database\Seeders;

use App\Models\Termin;
use Illuminate\Database\Seeder;

class TerminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Termin::factory()
            ->count(5)
            ->create();
    }
}

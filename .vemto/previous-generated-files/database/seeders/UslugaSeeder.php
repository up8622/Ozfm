<?php

namespace Database\Seeders;

use App\Models\Usluga;
use Illuminate\Database\Seeder;

class UslugaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usluga::factory()
            ->count(5)
            ->create();
    }
}

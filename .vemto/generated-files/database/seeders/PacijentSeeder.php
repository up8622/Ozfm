<?php

namespace Database\Seeders;

use App\Models\Pacijent;
use Illuminate\Database\Seeder;

class PacijentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pacijent::factory()
            ->count(5)
            ->create();
    }
}

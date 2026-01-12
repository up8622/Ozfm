<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $passwordHash = Hash::make('Test123!');

        Administrator::insert([
            [
                'ime' => 'Uros',
                'prezime' => 'Popovic',
                'godina_rodjenja' => 1980,
                'hash' => $passwordHash,
                'salt' => 'random_salt_1',
                'username' => 'uros',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ime' => 'Marija',
                'prezime' => 'Marić',
                'godina_rodjenja' => 1985,
                'hash' => $passwordHash,
                'salt' => 'random_salt_2',
                'username' => 'marija',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Terapeut;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TerapeutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $passwordHash = Hash::make('Test123!');

        Terapeut::insert([
            [
                'ime' => 'Marko',
                'prezime' => 'Marković',
                'jmbg' => '1234567890123',
                'broj_telefona' => '061111111',
                'username' => 'marko',
                'password_hash' => $passwordHash,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ime' => 'Ana',
                'prezime' => 'Anić',
                'jmbg' => '9876543210987',
                'broj_telefona' => '062222222',
                'username' => 'ana',
                'password_hash' => $passwordHash,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ime' => 'Petar',
                'prezime' => 'Petrović',
                'jmbg' => '1112223334445',
                'broj_telefona' => '063333333',
                'username' => 'petar',
                'password_hash' => $passwordHash,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

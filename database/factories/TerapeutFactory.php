<?php

namespace Database\Factories;

use App\Models\Terapeut;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TerapeutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Terapeut::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ime' => fake()->firstName(),
            'prezime' => fake()->lastName(),
            'jmbg' => fake()->numerify('#############'),
            'broj_telefona' => fake()->phoneNumber(),
            'password_hash' => \Hash::make('password'),
            'username' => fake()->userName(),
        ];
    }
}

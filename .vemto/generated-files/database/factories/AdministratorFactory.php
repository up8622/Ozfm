<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Administrator;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdministratorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Administrator::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ime' => fake()->text(255),
            'prezime' => fake()->text(255),
            'godina_rodjenja' => fake()->randomNumber(0),
            'hash' => fake()->text(255),
            'salt' => fake()->text(255),
            'username' => fake()->userName(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Termin;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TerminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Termin::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vreme' => fake()->dateTime(),
            'pacijent_id' => fake()->randomNumber(0),
            'terapeut_id' => fake()->randomNumber(),
            'usluga_id' => fake()->randomNumber(),
        ];
    }
}

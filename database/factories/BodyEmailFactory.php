<?php

namespace Database\Factories;

use App\Models\BodyEmail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BodyEmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = BodyEmail::class;

    public function definition()
    {
        return [
            "user_id" => User::all()->random()->id,
            "nombre" => $this->faker->sentence(2),
            "body" => $this->faker->paragraph(50),
        ];
    }
}

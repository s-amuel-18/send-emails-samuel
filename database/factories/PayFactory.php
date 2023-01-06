<?php

namespace Database\Factories;

use App\Models\Pay;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class PayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = Arr::random([Pay::DEBT_TYPE, Pay::DEBT_TYPE], 1)[0];

        return [
            "user_id" => User::all()->random()->id,
            "name" => $this->faker->sentence(),
            "payment_amount" => $this->faker->randomFloat('2', 0, 2),
            "description" => $this->faker->text(50),
            "type" =>  $type,
        ];
    }
}

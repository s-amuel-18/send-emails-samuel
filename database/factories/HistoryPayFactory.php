<?php

namespace Database\Factories;

use App\Models\HistoryPay;
use App\Models\Pay;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class HistoryPayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = Arr::random([HistoryPay::ADD_TYPE, HistoryPay::SUBTRACT_TYPE], 1)[0];
        return [
            "user_id" => User::all()->random()->id,
            "pay_id" => Pay::all()->random()->id,
            "payment_amount" => $this->faker->randomFloat('2', 100, 2),
            "description" => $this->faker->text(50),
            "type" =>  $type,
        ];
    }
}

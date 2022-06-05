<?php

namespace Database\Factories;

use App\Models\BillingTime;
use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Income::class;

    public function definition()
    {
        return [
            "billing_time_id" => BillingTime::all()->random()->id,
            "name" => $this->faker->sentence(),
            "desc" => $this->faker->text(50),
            "price" => rand(100, 400),
        ];
    }
}

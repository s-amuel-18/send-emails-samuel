<?php

namespace Database\Factories;

use App\Models\BillingTime;
use App\Models\Spents;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Spents::class;

    public function definition()
    {
        return [
            "billing_time_id" => BillingTime::all()->random()->id,
            "name" => $this->faker->sentence(),
            "desc" => $this->faker->text(50),
            "price" => rand(20, 100),
        ];
    }
}

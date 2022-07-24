<?php

namespace Database\Factories;

use App\Models\CategoryService;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class serviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => User::all()->random()->id,
            "category_id" => CategoryService::all()->random()->id,
            "name" => $this->faker->name(),
            "price" => rand(100, 400),
        ];
    }
}

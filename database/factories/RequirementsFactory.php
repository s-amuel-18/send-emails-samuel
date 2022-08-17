<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RequirementsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence();

        return [
            "user_id" => User::all()->random()->id,
            "category_id" => Category::requirements()->get()->random()->id,
            "name" => $name,
            "description" => $this->faker->text(25),
            "url" => $this->faker->randomElement(["https://www." . Str::slug($name) . ".com", null]),
        ];
    }
}

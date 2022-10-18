<?php

namespace Database\Factories;

use App\Models\Testimony;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Testimony::class;

    public function definition()
    {
        return [
            "user_id" => User::all()->random()->id,
            "name" => $this->faker->name(),
            "position" => "Ceo Empresa",
            "rating" => rand(1, 5),
            "title" => $this->faker->text(20),
            "review" => $this->faker->sentence(15),
            "published" => rand(0, 1),
        ];
    }
}

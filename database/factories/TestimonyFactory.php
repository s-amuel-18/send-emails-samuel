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
        do {
            $uuid = rand(11111111, 99999999);

            $uuid_exist = Testimony::where("uuid", $uuid)->count();
        } while ($uuid_exist >= 1);

        return [
            "uuid" => $uuid,
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

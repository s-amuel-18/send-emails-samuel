<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Contact_email;
use Illuminate\Database\Eloquent\Factories\Factory;

class Contact_emailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Contact_email::class;
    public function definition()
    {
        $nombre_empresa = $this->faker->sentence();

        // $created  = $this->faker->dateTimeBetween($startDate = "-3 month", $endDate = "now +6 month");
        $created  = $this->faker->dateTime();

        return [
            "user_id" => User::all()->random()->id,
            "nombre_empresa" => $this->faker->randomElement([$nombre_empresa, null]),
            "url" => $this->faker->randomElement(["https://www." . Str::slug($nombre_empresa) . ".com", null]),
            "email" =>  $this->faker->randomElement([$this->faker->unique()->safeEmail(), null]) ,
            "estado" => $this->faker->randomElement([0, 1]),
            "whatsapp" => $this->faker->randomElement(["https://ws-" . Str::slug($nombre_empresa) . ".com", null]),
            "instagram" => $this->faker->randomElement(["https://ins-" . Str::slug($nombre_empresa) . ".com", null]),
            "facebook" => $this->faker->randomElement(["https://facebook-" . Str::slug($nombre_empresa) . ".com", null]),
            "descripcion" => $this->faker->text(50),
            "created_at" => $created,
        ];
    }
}

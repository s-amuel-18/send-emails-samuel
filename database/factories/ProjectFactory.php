<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Project::class;

    public function definition()
    {
        $name = $this->faker->sentence();
        $slug = Str::slug($name);
        $created  = $this->faker->dateTimeThisMonth();

        return [
            "user_id" => User::all()->random()->id,
            "name" => $name,
            "slug" => $slug,
            "published" => rand(0, 1),
            "description" => $this->faker->text(50),
            "image_front_page" => $this->faker->imageUrl(200, 116),
            "created_at" => $created,
        ];
    }
}

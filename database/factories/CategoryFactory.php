<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Requirements;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $catgoriables_type = collect([
            Requirements::class, Project::class
        ]);

        $random_categoriables = rand(0, ($catgoriables_type->count() - 1));

        return [
            "name" => str_replace(".", "", $this->faker->text(15)),
            "catgoriable_type" => $catgoriables_type[$random_categoriables],
        ];
    }
}

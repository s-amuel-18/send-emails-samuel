<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\ItemHelp;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = Project::all();
        $categories = Category::project()->take(rand(1, 3))->get();

        foreach ($projects as $project) {
            Image::factory(3)->create([
                "imageable_id" => $project->id,
                "imageable_type" => Project::class,
            ]);

            ItemHelp::factory(3)->create([
                "helpeable_id" => $project->id,
                "helpeable_type" => Project::class,
            ]);

            $project->categories()->attach($categories->pluck("id")->all());
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\CategoryService;
use Illuminate\Database\Seeder;

class CategoryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // programacion
        CategoryService::create([
            "name" => "Progracion",
            "icon_class" => "fa fa-code"
        ]);

        // Diseño
        CategoryService::create([
            "name" => "Diseño",
            "icon_class" => "fa fa-paint-brush"
        ]);
    }
}

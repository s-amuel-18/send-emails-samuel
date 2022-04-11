<?php

namespace Database\Seeders;

// use App\Models\body_email;

use App\Models\Body_email;
use App\Models\BodyEmail;
use App\Models\Contact_email;
// use Database\Factories\BodyEmailFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        $this->call(UserSeeder::class);
        Contact_email::factory(200)->create();
        BodyEmail::factory(10)->create();
        // Factory::factoryForModel("App\Models\Body_email");
    }
}

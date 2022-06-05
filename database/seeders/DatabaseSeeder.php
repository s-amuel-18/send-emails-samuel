<?php

namespace Database\Seeders;

// use App\Models\body_email;

use App\Models\BillingTime;
use App\Models\Body_email;
use App\Models\BodyEmail;
use App\Models\Contact_email;
use App\Models\Income;
use App\Models\Spents;
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
        $this->call(RoleSeeder::class);
        // \App\Models\User::factory(9)->create();
        $this->call(UserSeeder::class);
        $this->call(BillingTimeSeeder::class);
        Income::factory(7)->create();
        Spents::factory(4)->create();
        // BodyEmail::factory(10)->create();
        // $this->call(EnvioEmailSeeder::class);
        // Factory::factoryForModel("App\Models\Body_email");
    }
}

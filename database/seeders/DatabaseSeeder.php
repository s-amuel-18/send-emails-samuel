<?php

namespace Database\Seeders;

// use App\Models\body_email;

use App\Models\BillingTime;
use App\Models\Body_email;
use App\Models\BodyEmail;
use App\Models\CategoryService;
use App\Models\Contact_email;
use App\Models\Income;
use App\Models\Service;
use App\Models\Spents;
use App\Models\User;
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
        $this->call(CategoryServiceSeeder::class);
        // Income::factory(7)->create();
        // Spents::factory(4)->create();
        // BodyEmail::factory(10)->create();
        Contact_email::factory(10)->create();
        // $this->call(EnvioEmailSeeder::class);
        // CategoryService::factory(5)->create();
        // Service::factory(10)->create();
        // Factory::factoryForModel("App\Models\Body_email");

        for ($i = 0; $i < 1000; $i++) {
            $user = User::all()->random();
            $contact = Contact_email::all()->random();

            $user->emailEnviado()->attach($contact->id);
        }
    }
}

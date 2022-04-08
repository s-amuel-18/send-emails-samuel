<?php

namespace Database\Seeders;

use App\Models\Contact_email;
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
        \App\Models\User::factory(20)->create();
        $this->call(UserSeeder::class);
        Contact_email::factory(500)->create();
    }
}

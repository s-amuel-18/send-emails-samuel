<?php

namespace Database\Seeders;

// use App\Models\body_email;

use App\Models\BillingTime;
use App\Models\Body_email;
use App\Models\BodyEmail;
use App\Models\Category;
use App\Models\CategoryService;
use App\Models\Contact_email;
use App\Models\HistoryPayments;
use App\Models\Income;
use App\Models\Pay;
use App\Models\Project;
use App\Models\Requirements;
use App\Models\Service;
use App\Models\Spents;
use App\Models\Testimony;
use App\Models\User;
// use Database\Factories\BodyEmailFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Storage::deleteDirectory("images");
        // Storage::makeDirectory("images");


        $this->call(RoleSeeder::class);
        // \App\Models\User::factory(9)->create();
        $this->call(UserSeeder::class);
        $this->call(BillingTimeSeeder::class);
        // \App\Models\Project::factory(20)->create();
        // \App\Models\Category::factory(10)->create();
        // $this->call(ProjectSeeder::class);
        // $this->call(CategoryServiceSeeder::class);
        Income::factory(3)->create();
        Spents::factory(5)->create();
        // BodyEmail::factory(10)->create();
        Contact_email::factory(10)->create();
        Category::factory(50)->create();
        Requirements::factory(50)->create();
        // Testimony::factory(20)->create();
        Project::factory(20)->create();
        Pay::factory(10)->create();
        HistoryPayments::factory(40)->create();
        // $this->call(EnvioEmailSeeder::class);
        // CategoryService::factory(5)->create();
        // Service::factory(10)->create();
        // Factory::factoryForModel("App\Models\Body_email");

        $this->call(MailsSendHistory::class);
    }
}

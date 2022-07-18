<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Brandon Bello",
            "email" => "brandon91596@gmail.com",
            "username" => "branmarvel",
            "password" => Hash::make("12345678"),
        ])->assignRole("Administrador");
    }
}

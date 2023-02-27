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
            "name" => "Samuel Graterol",
            "email" => "c@c.com",
            "username" => "samuel_grateroñ",
            "password" => Hash::make("11111111"),
        ])->assignRole("Administrador");

        User::create([
            "name" => "Usuario De Prueba",
            "email" => "s@s.com",
            "username" => "usuario_de_prueba",
            "password" => Hash::make("11111111"),
        ])->assignRole("Trabajador");
    }
}

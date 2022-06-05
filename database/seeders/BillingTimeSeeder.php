<?php

namespace Database\Seeders;

use App\Models\BillingTime;
use Illuminate\Database\Seeder;

class BillingTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $illingTimes = [
            ["name" => "Diario", "days" => 30],
            ["name" => "Semanal", "days" => 4],
            ["name" => "Quincenal", "days" => 2],
            ["name" => "Mensual", "days" => 1],
        ];

        foreach ($illingTimes as $time) {
            BillingTime::create($time);
        }
    }
}

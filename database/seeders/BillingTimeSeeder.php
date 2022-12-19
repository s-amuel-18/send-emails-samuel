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
            ["name" => "Diario", "days" => 30/* , "profit_per_day" => 1 */],
            ["name" => "Semanal", "days" => 4/* , "profit_per_day" => 7 */],
            ["name" => "Quincenal", "days" => 2/* , "profit_per_day" => 15 */],
            ["name" => "Mensual", "days" => 1/* , "profit_per_day" => 30 */],
        ];

        foreach ($illingTimes as $time) {
            BillingTime::create($time);
        }
    }
}

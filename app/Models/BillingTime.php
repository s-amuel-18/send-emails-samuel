<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingTime extends Model
{
    use HasFactory;

    public const DAY = 1;
    public const WEEK = 7;
    public const FORTNIGHT = 15;
    public const MONTHLY = 30;

    public function incomes()
    {
        return $this->hasMany(Income::class, "billing_time_id", "id");
    }

    public function spemts()
    {
        return $this->hasMany(Spents::class, "billing_time_id", "id");
    }

    // * funciones
    public function spent_for_time()
    {
        $data_to_calculate = [
            "Diario" => [
                "day" => 1, "week" => 1, "fortnight" => 1, "month" => 1
            ],
            "Semanal" => [
                "day" => null, "week" => 1, "fortnight" => 1, "month" => 1
            ],
            "Quincenal" => [
                "day" => null, "week" => null, "fortnight" => 1, "month" => 1
            ],
            "Mensual" => [
                "day" => null, "week" => null, "fortnight" => null, "month" => 1
            ],
        ];

        return collect($data_to_calculate[$this->name]);
    }
    // * funciones end

    // * atributos
    public function getCalculateAttribute()
    {

        $calc = $this->spent_for_time()->map(function ($calculate) {

            return $calculate ? $this->spemts_sum_price * $calculate : null;
        });

        return collect($calc);
    }
    // * atributos end 

}

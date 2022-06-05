<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Spents extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "desc",
        "price"
    ];

    public function billingTime()
    {
        return $this->belongsTo(BillingTime::class, "billing_time_id", "id");
    }

    public function scopeTotalSpents($query)
    {
        return $query->select(
            DB::raw("SUM( spents.price * billing_times.days ) AS sum_price")
        )->join("billing_times", "billing_times.id", "=", "spents.billing_time_id")
            ->first()->sum_price ?? 0;
    }

    public function scopePorcentegeSpent($query)
    {
        $grossIncome = Income::grossIncome();
        return $grossIncome > 0 ? (($query->totalSpents() * 100) / $grossIncome) : "+100";
    }
}

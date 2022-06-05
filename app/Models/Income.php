<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Income extends Model
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

    public function scopeGrossIncome($query)
    {
        return $query->select(
            DB::raw("SUM( incomes.price * billing_times.days ) AS sum_price")
        )->join("billing_times", "billing_times.id", "=", "incomes.billing_time_id")
            ->first()->sum_price ?? 0;
    }

    public function scopeNetIncome($query)
    {
        $grossIncome = $this->grossIncome();
        $totalSpents = Spents::totalSpents();

        if ($totalSpents > $grossIncome) {
            return 0;
        }

        return $grossIncome > 0 ? ($grossIncome - $totalSpents) : 0;
    }


    public function scopeDailyEarnings($query)
    {
        $netIncome = $query->netIncome() ?? 0;
        // return $netIncome;
        return $netIncome > 0 ? ($netIncome / BillingTime::MONTHLY) : 0;
    }

    public function scopePorcentegeIncome($query)
    {
        $netIncome = $query->netIncome();
        return $netIncome > 0 ? (($netIncome * 100) / $query->grossIncome()) : 0;
    }
}

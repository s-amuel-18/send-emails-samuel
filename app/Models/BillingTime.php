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
}

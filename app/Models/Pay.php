<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "name",
        "payment_amount",
        "image_url",
        "description",
        "type"
    ];
    // ? estados dos constantes nos sirven de apoyo para identificar el tipo de prestamo, si es un prestamo que el usuario dá o un prestamo que nosotros solicitamos
    // * tipo deuda
    const DEBT_TYPE = 1;
    // * tipo prestamo
    const LOAN_TYPE = 2;

    public function history_pay()
    {
        return $this->hasMany(HistoryPay::class, "pay_id");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class HistoryPay extends Pivot
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "pay_id",
        "payment_amount",
        "description",
        "type"
    ];

    // ? estados dos constantes (add_TYPE SUBTRACT_TYPE) nos van a permitir identificar el tipo de registro que se pagó, es decir si se pidio prestado o se pago parte de la deuda
    // * tipo agregar
    const ADD_TYPE = 1;
    // * tipo restar
    const SUBTRACT_TYPE = 2;

    public function pay()
    {
        return $this->belongsTo(Pay::class, "pay_id");
    }
}

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

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    // * atributos
    public function getTypeStringAttribute()
    {
        $arr_types = [
            $this::DEBT_TYPE => "deuda",
            $this::LOAN_TYPE => "prestamo",
        ];

        $type_string = $arr_types[$this->type] ?? null;

        return $type_string;
    }

    public function getRouteImageAttribute()
    {
        return $this->image_url ? asset('storage/' . $this->image_url) : null;
    }
}

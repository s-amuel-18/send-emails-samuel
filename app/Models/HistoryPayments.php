<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPayments extends Model
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

    // public function pay()
    // {
    //     return $this->belongsTo(Pay::class, "pay_id");
    // }

    // * atributos
    public function getTypeStringAttribute()
    {
        // * creamos array con palabras dependiendo del tipo
        $arr_types = [
            $this::ADD_TYPE => [
                "sing" => [
                    "word" => "deducción",
                ],
                "plur" => [
                    "word" => "deducciónes",
                ]
            ],
            $this::SUBTRACT_TYPE => [
                "sing" => [
                    "word" => "cargo",
                ],
                "plur" => [
                    "word" => "cargos",
                ]
            ],
        ];

        $arr_types[$this::ADD_TYPE]["sing"]["msg"] = "La " . $arr_types[$this::ADD_TYPE]["sing"]["word"] . " %msg%";
        $arr_types[$this::ADD_TYPE]["plur"]["msg"] = "Las " . $arr_types[$this::ADD_TYPE]["plur"]["word"] . " %msg%";
        $arr_types[$this::SUBTRACT_TYPE]["sing"]["msg"] = "El " . $arr_types[$this::SUBTRACT_TYPE]["sing"]["word"] . " %msg%";
        $arr_types[$this::SUBTRACT_TYPE]["plur"]["msg"] = "Los " . $arr_types[$this::SUBTRACT_TYPE]["plur"]["word"] . " %msg%";

        $type_string = $arr_types[$this->type] ?? null;

        return $type_string;
    }

    // * functions
    public function messageType($msg)
    {
        return $this->typeString
            ? str_replace("%msg%", $msg,  $this->typeString["sing"]["msg"])
            : null;
    }
}

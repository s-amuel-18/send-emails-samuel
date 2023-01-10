<?php

namespace App\Http\Requests;

use App\Models\HistoryPayments;
use App\Models\Pay;
use Illuminate\Foundation\Http\FormRequest;

class HistoryPaymentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // * validamos que el pago al que está asociado el historial halla sido creado por el mismo usuario
        $pay_id = $this->input("pay_id");
        $pay = Pay::find($pay_id);
        $sameUserPay =  $this->user()->can("view", $pay);

        return $sameUserPay;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $types = implode(",", [HistoryPayments::ADD_TYPE, HistoryPayments::SUBTRACT_TYPE]);

        return [
            "pay_id" => "required|exists:pays,id",
            "payment_amount" => "required|numeric",
            "description" => "nullable|string",
            "type" => "required|in:" . $types,
        ];
    }
}

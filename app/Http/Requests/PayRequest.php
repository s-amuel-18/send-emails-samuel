<?php

namespace App\Http\Requests;

use App\Models\Pay;
use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $types = implode(",", [Pay::LOAN_TYPE, Pay::DEBT_TYPE]);
        // dd($types);
        return [
            "name" => "required|string|max:191",
            "payment_amount" => "required|numeric",
            "description" => "nullable|string",
            "type" => "required|in:" . $types,
            "image" => "nullable|image|mimes:jpeg,png,jpg|max:6000",
        ];
    }
}

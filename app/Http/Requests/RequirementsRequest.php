<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequirementsRequest extends FormRequest
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
        return [
            "name" => "required|max:255|string",
            "category_id" => "required|exists:categories,id",
            "url" => "required|active_url",
            "description" => "nullable|string",
            "private" => "nullable|numeric|min:0|max:1",
        ];
    }
}

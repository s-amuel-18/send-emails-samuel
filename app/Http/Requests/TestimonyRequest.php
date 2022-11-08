<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonyRequest extends FormRequest
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
            "name" => "required|string|max:191",
            "position" => "required|string|max:191",
            "rating" => "required|numeric",
            "title" => "required|string|max:191",
            "review" => "required|string",
            "image" => "nullable|image|mimes:jpeg,png|max:6000",
        ];
    }
}

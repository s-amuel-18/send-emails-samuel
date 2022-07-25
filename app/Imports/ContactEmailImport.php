<?php

namespace App\Imports;

use App\Models\Contact_email;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;

class ContactEmailImport implements ToModel, WithHeadingRow, WithValidation,SkipsOnError
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Contact_email([
            "email" => $row["email"]
        ]);
    }

    public function rules(): array
    {
        return [
            "*.email" => [
                "required",
                "email",
            ]
        ];
    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}

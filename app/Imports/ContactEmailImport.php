<?php

namespace App\Imports;

use App\Models\Contact_email;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ContactEmailImport implements ToModel, WithHeadingRow, WithValidation
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
                "unique:contact_emails,email"
            ]
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Imports\ContactEmailImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportController extends Controller
{
    public function contactEmail(Request $request)
    {
        $data = request()->validate([
            "excel_file" => "required|mimes:xlsx,Xls"
        ]);
        $file = $data["excel_file"];

        $erros = [];

        try {
            Excel::import(new ContactEmailImport, $file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();


            foreach ($failures as $failure) {
                $err["row"] = $failure->row(); // row that went wrong
                $err["attribute"] = $failure->attribute(); // either heading key (if using heading row concern) or column index
                $err["errors"] = $failure->errors(); // Actual error messages from Laravel validator
                $err["values"] = $failure->values(); // The values of the row that has failed.

                $erros[] = $err;
            }
            $message = [
                "message" => "El documento contiene el email ya existente '{$erros[0]["values"]["email"]}'",
                "color" => "warning"
            ];

            return redirect()->back()->with("message", $message);
        }

        $message = [
            "message" => "Documento importado correctamente.",
            "color" => "success"
        ];

        return redirect()->back()->with("message", $message);
    }
}

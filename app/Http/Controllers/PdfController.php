<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    public function cartaPresentacion()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.carta_precentacion');
        return $pdf->stream('invoice.pdf');
    }
}

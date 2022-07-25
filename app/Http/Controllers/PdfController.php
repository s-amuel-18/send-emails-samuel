<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    public function cartaPresentacion()
    {
        // dd(storage_path("asset.png"));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.carta_precentacion');
        return $pdf->stream('carta presentacion.pdf');
    }
    public function Services()
    {
        // dd(storage_path("asset.png"));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.Services');
        return $pdf->stream('lista de servicios.pdf');
    }
}

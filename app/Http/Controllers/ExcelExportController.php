<?php

namespace App\Http\Controllers;

use App\Models\Contact_email;
use Illuminate\Http\Request;

class ExcelExportController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:contact_email.estadisticas")->only(
            "contactEmail"
        );
    }

    public function contactEmail(Request $request)
    {
        $search = $request["search"];

        $contact_emails_query = Contact_email::withCount("envios")
            ->whereNotNull("email")
            ->orderBy("created_at", "DESC");

        if ($search) {
            $contact_emails_query->searchLike($search);
        }
        $contact_emails = $contact_emails_query->get();
        return $contact_emails->downloadExcel("reporte.xlsx", null, true);
    }
}

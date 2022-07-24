<?php

namespace App\Exports;

use App\Models\Contact_email;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactEmailExport implements FromView
{
    public function view(): View
    {

        return view("admin.excels.contact_emails");
    }
}

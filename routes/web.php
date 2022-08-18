<?php

// use App\Http\Controllers\contact_email\BodyEmailController;
// use App\Http\Controllers\contact_email\BodyEmailsController;

// use App\Http\Controllers\BodyEmailController;

// use App\Http\Controllers\BodyEmailController;

use App\Http\Controllers\contact_email\BodyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\contact_email\ContactEmailController;
use App\Http\Controllers\contact_email\EmailSendController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\ExcelExportController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RecomendacionMejoraController;
use App\Http\Controllers\RequirementsController;
// use App\Http\Controllers\contact_email\Email_send;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpentsController;
use App\Mail\ServicioMaillable;
use App\Models\BodyEmail;
use App\Models\RecomendacionMejora;
use App\Models\Service;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(["register" => false]);

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')
    ->name('home.index');

// users
Route::resource("user", UserController::class)->except("show")->middleware("auth")->names("user");

// emails
Route::resource("contact-email", ContactEmailController::class)->except("show")->middleware("auth")->names("contact_email");
Route::get('/contact-email/datatable', [ContactEmailController::class, 'datatable'])->middleware("auth")->name('contact_email.datatable');
Route::get('/contact-email/consulta-emails', [ContactEmailController::class, 'getContactEmails'])->middleware("auth")->name('contact_email.getContactEmails');
Route::get('/contact-email/estadisticas', [ContactEmailController::class, 'estadisticas'])->middleware("auth")->name('contact_email.estadisticas');
Route::get('/contact-email/historial-envios', [ContactEmailController::class, 'shipping_history'])->middleware("auth")->name('contact_email.shipping_history');
Route::get('/contact-email/historial-envios/datatable', [ContactEmailController::class, 'shipping_history_datatable'])->middleware("auth")->name('contact_email.shipping_history_datatable');
Route::get('/contact-email/historial-envios/{id}', [ContactEmailController::class, 'get_details_shippung'])->middleware("auth")->name('contact_email.shipping_details');

// body
Route::resource("body-email", BodyEmailController::class)->except("show")->middleware("auth")->names("bodyEmail");

// send emails
Route::get('envio-email/redaccion-detallada', [EmailSendController::class, 'index'])->name('envio_email.index');
Route::post('/envio-email', [EmailSendController::class, 'envioEmail'])->name('envio_email.envioEmail');
Route::get('/envio-email/servicio', [EmailSendController::class, 'email'])->name('envio_email.email');
Route::post('/envio-email/crear-informacio', [EmailSendController::class, 'crear_informacio'])->name('envio_email.crear_informacio');
Route::post('/envio-email/contacto', [EmailSendController::class, 'client_contact_front'])->name('envio_email.client_contact_front');

// roles
Route::resource("role", RoleController::class)->except("show")->middleware("auth")->names("role");


Route::middleware(["can:managment.index", "auth"])->group(function () {

    // administracion
    Route::get("administracion", [ManagementController::class, "index"])
        ->name("managment.index");
    // income
    Route::resource("income", IncomeController::class)->except("index")->names("income");

    Route::resource("debt", DebtController::class)->names("debt");
    Route::get("managment/consult_debts", [DebtController::class, "consult_debts_view"])->name("debt.consult_debts_view");

    // spents
    Route::resource("spent", SpentsController::class)->except("index")->names("spent");
});


// Recomendaciones asi el sistema
Route::resource("recomendaciones", RecomendacionMejoraController::class)->middleware("auth")->names("recomendacion");

// servicios
Route::resource("servicios", ServiceController::class)->except("show")->middleware("auth")->names("service");


// preview email fluxel
Route::get("email", function () {
    return view("emails.fluxel_code_service");
});

// pdf
Route::get("pdf/presentacion", [PdfController::class, "cartaPresentacion"])->name("pdf.cartaPresentacion");
Route::get("pdf/servicios", [PdfController::class, "Services"])->name("pdf.services");

// excel export
Route::get("emails/export/excel", [ExcelExportController::class, "contactEmail"])->middleware("auth")->name("contactEmail.export_excel");

// excel import
Route::post("emails/import/excel", [ExcelImportController::class, "contactEmail"])->middleware("auth")->name("contactEmail.import_excel");

// requerimientos
Route::post("requerimientos/crear", [RequirementsController::class, "store"])->name("requirements.store");
Route::prefix('requerimientos')->middleware(["auth"])->group(function () {
    Route::get("/datatable", [RequirementsController::class, "datatable"])->name("requirements.datatable");
    Route::get("/{id}", [RequirementsController::class, "get_requirement"])->name("requirements.get_requirement");
    Route::post("/actualizar/{id}", [RequirementsController::class, "update"])->name("requirements.update");
    Route::delete("/eliminar", [RequirementsController::class, "destroy"])->name("requirements.destroy");
});

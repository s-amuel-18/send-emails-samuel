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
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\RecomendacionMejoraController;
// use App\Http\Controllers\contact_email\Email_send;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpentsController;
use App\Mail\ServicioMaillable;
use App\Models\BodyEmail;
use App\Models\RecomendacionMejora;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

// users
Route::resource("user", UserController::class)->except("show")->middleware("auth")->names("user");

// emails
Route::resource("contact-email", ContactEmailController::class)->except("show")->middleware("auth")->names("contact_email");
Route::get('/contact-email/datatable', [ContactEmailController::class, 'datatable'])->name('contact_email.datatable');
Route::get('/contact-email/estadisticas', [ContactEmailController::class, 'estadisticas'])->name('contact_email.estadisticas');

// body
Route::resource("body-email", BodyEmailController::class)->except("show")->middleware("auth")->names("bodyEmail");

// send emails
Route::get('envio-email/redaccion-detallada', [EmailSendController::class, 'index'])->name('envio_email.index');
Route::post('/envio-email', [EmailSendController::class, 'envioEmail'])->name('envio_email.envioEmail');
Route::get('/envio-email/servicio', [EmailSendController::class, 'email'])->name('envio_email.email');
Route::post('/envio-email/crear-informacio', [EmailSendController::class, 'crear_informacio'])->name('envio_email.crear_informacio');

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

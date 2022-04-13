<?php

// use App\Http\Controllers\contact_email\BodyEmailController;
// use App\Http\Controllers\contact_email\BodyEmailsController;

// use App\Http\Controllers\BodyEmailController;

// use App\Http\Controllers\BodyEmailController;

use App\Http\Controllers\contact_email\BodyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\contact_email\ContactEmailController;
use App\Http\Controllers\contact_email\Email_send;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// users
Route::resource("user", UserController::class)->except("show")->middleware("auth")->names("user");

// emails
Route::resource("contact-email", ContactEmailController::class)->except("show")->middleware("auth")->names("contact_email");
Route::get('/contact-email/datatable', [ContactEmailController::class, 'datatable'])->name('contact_email.datatable');
Route::get('/contact-email/estadisticas', [ContactEmailController::class, 'estadisticas'])->name('contact_email.estadisticas');
// body
Route::resource("body-email", BodyEmailController::class)->except("show")->middleware("auth")->names("bodyEmail");
// send emails
Route::get('/envio-email', [Email_send::class, 'index'])->name('envio_email.index');



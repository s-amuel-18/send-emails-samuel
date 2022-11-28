<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/login", [AuthController::class, "login"])->name("auth.login");
Route::middleware('auth:sanctum')->post("/logout", [AuthController::class, "logout"])->name("auth.logout");

Route::middleware('auth:sanctum')->group(function () {
    // * aginaturas (categorias)
    Route::get("/subject", [SubjectController::class, "get_all"])
        ->name("subject.get_all"); // * todas las categorias
    Route::get("/subject/create", [SubjectController::class, "store"])
        ->name("subject.store"); // * crear nueva categoría
    Route::post("/subject/update/{id}", [SubjectController::class, "update"])
        ->name("subject.update"); // * actualizar categoría
    Route::delete("/subject/{id}/delete", [SubjectController::class, "destroy"])
        ->name("subject.delete"); // * Eliminar categoría

    // * Notas 
    Route::get("/subject/{id_category}/notes", [SubjectController::class, "notes"])
        ->name("subject.notes"); // * Eliminar categoría
});

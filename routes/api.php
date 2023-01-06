<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\API\PayController;
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
    Route::get("/subjects", [SubjectController::class, "get_all"])
        ->name("subject.get_all"); // * todas las categorias
    Route::post("/subject/store", [SubjectController::class, "store"])
        ->name("subject.store"); // * crear nueva categoría
    Route::put("/subject/{id}/update", [SubjectController::class, "update"])
        ->name("subject.update"); // * actualizar categoría
    Route::delete("/subject/{id}/delete", [SubjectController::class, "destroy"])
        ->name("subject.delete"); // * Eliminar categoría

    // * Notas 
    Route::get("/subject/{id_category}/notes", [SubjectController::class, "notes"])
        ->name("note.notes"); // * Notas de la asignatura

    Route::get("/subject/note/{nota}", [SubjectController::class, "note_show"])
        ->name("note.show"); // * show nota

    Route::post("/subject/notes/store", [SubjectController::class, "note_store"])
        ->name("note.store"); // * crear nota 

    Route::put("/subject/notes/{note}/update", [SubjectController::class, "note_update"])
        ->name("note.update"); // * actualizar nota 

    Route::delete("/subject/notes/{note}/delete", [SubjectController::class, "note_delete"])
        ->name("note.delete"); // * eliminar nota


    // * pagos
    Route::prefix("payments")->group(function () {
        // * index /payments
        Route::get("/", [PayController::class, "index"])->name("pay.index");
        // * /payments/store
        Route::post("/store", [PayController::class, "store"])->name("pay.store");
        // * /payments/show
        Route::get("/{pay}", [PayController::class, "show"])
            ->name("pay.show");
        // * /payments/update/
        Route::put("/{pay}/update", [PayController::class, "update"])->name("pay.update");
        // * /payments/destroy/
        Route::delete("/{pay}/destroy", [PayController::class, "destroy"])->name("pay.destroy");
    });
});

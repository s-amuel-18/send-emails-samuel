<?php

// * use App\Http\Controllers\contact_email\BodyEmailController;
// * use App\Http\Controllers\contact_email\BodyEmailsController;

// * use App\Http\Controllers\BodyEmailController;

// * use App\Http\Controllers\BodyEmailController;

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
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RecomendacionMejoraController;
use App\Http\Controllers\RequirementsController;
// * use App\Http\Controllers\contact_email\Email_send;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SpentsController;
use App\Http\Controllers\TestimonyController;
use App\Mail\ServicioMaillable;
use App\Models\BodyEmail;
use App\Models\RecomendacionMejora;
use App\Models\Service;
use App\Models\Testimony;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Settings;

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

Auth::routes(
    [
        "password.reset" => false,
        "register" => false,
        "reset" => false,
        "confirm" => false,
        "email" => false,
    ]
);

// * front
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/proyecto/{slug}', [FrontController::class, 'project'])->name('project.front.show');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')
    ->name('home.index');

// * users
Route::resource("user", UserController::class)->except("show")->middleware("auth")->names("user");

// * emails
Route::resource("contact-email", ContactEmailController::class)->except("show")->middleware("auth")->names("contact_email");
Route::get('/contact-email/datatable', [ContactEmailController::class, 'datatable'])->middleware("auth")->name('contact_email.datatable');
Route::get('/contact-email/consulta-emails', [ContactEmailController::class, 'getContactEmails'])->middleware("auth")->name('contact_email.getContactEmails');
Route::get('/contact-email/estadisticas', [ContactEmailController::class, 'estadisticas'])->middleware("auth")->name('contact_email.estadisticas');
Route::get('/contact-email/historial-envios', [ContactEmailController::class, 'shipping_history'])->middleware("auth")->name('contact_email.shipping_history');
Route::get('/contact-email/historial-envios/datatable', [ContactEmailController::class, 'shipping_history_datatable'])->middleware("auth")->name('contact_email.shipping_history_datatable');
Route::get('/contact-email/historial-envios/{id}', [ContactEmailController::class, 'get_details_shippung'])->middleware("auth")->name('contact_email.shipping_details');
Route::post('/contact-email/contacto-alternativo/{contact_email}', [ContactEmailController::class, 'alternative_contact'])->middleware("auth")->name('contact_email.alternative_contact');
Route::patch('/contact-email/actualizar-email/{contact_email}', [ContactEmailController::class, 'update_email_async'])->middleware("auth")->name('contact_email.update_email_async');

// * body
Route::resource("body-email", BodyEmailController::class)->except("show")->middleware("auth")->names("bodyEmail");

// * send emails
Route::get('envio-email/redaccion-detallada', [EmailSendController::class, 'index'])->name('envio_email.index');
Route::post('/envio-email', [EmailSendController::class, 'envioEmail'])->name('envio_email.envioEmail');
Route::get('/envio-email/servicio', [EmailSendController::class, 'email'])->name('envio_email.email');
Route::post('/envio-email/crear-informacio', [EmailSendController::class, 'crear_informacio'])->name('envio_email.crear_informacio');
Route::post('/envio-email/contacto', [EmailSendController::class, 'client_contact_front'])->name('envio_email.client_contact_front');

// * roles
Route::resource("role", RoleController::class)->except("show")->middleware("auth")->names("role");


Route::middleware(["can:managment.index", "auth"])->group(function () {

    // * administracion
    Route::get("administracion", [ManagementController::class, "index"])
        ->name("managment.index");
    // * income
    Route::resource("income", IncomeController::class)->except("index")->names("income");

    Route::resource("debt", DebtController::class)->names("debt");
    Route::get("managment/consult_debts", [DebtController::class, "consult_debts_view"])->name("debt.consult_debts_view");

    // * spents
    Route::resource("spent", SpentsController::class)->except("index")->names("spent");
});


// * Recomendaciones asi el sistema
Route::resource("recomendaciones", RecomendacionMejoraController::class)->middleware("auth")->names("recomendacion");

// * servicios
Route::resource("servicios", ServiceController::class)->except("show")->middleware("auth")->names("service");


// * preview email fluxel
Route::get("email", function () {
    return view("emails.fluxel_code_service");
});

// * pdf
Route::get("pdf/presentacion", [PdfController::class, "cartaPresentacion"])->name("pdf.cartaPresentacion");
Route::get("pdf/servicios", [PdfController::class, "Services"])->name("pdf.services");

// * excel export
Route::get("emails/export/excel", [ExcelExportController::class, "contactEmail"])->middleware("auth")->name("contactEmail.export_excel");

// * excel import
Route::post("emails/import/excel", [ExcelImportController::class, "contactEmail"])->middleware("auth")->name("contactEmail.import_excel");

// * requerimientos
Route::prefix('requerimientos')->middleware(["auth"])->group(function () {
    // * requirements
    Route::get("/datatable", [RequirementsController::class, "datatable"])->name("requirements.datatable");
    Route::get("/{id}", [RequirementsController::class, "get_requirement"])->name("requirements.get_requirement");
    Route::post("/crear", [RequirementsController::class, "store"])->name("requirements.store");
    Route::post("/actualizar/{id}", [RequirementsController::class, "update"])->name("requirements.update");
    Route::delete("/eliminar", [RequirementsController::class, "destroy"])->name("requirements.destroy");

    // * categories
    Route::post("/categoria/crear", [RequirementsController::class, "category_store"])->name("requirements.category_store");
    Route::post("/categoria/actualizar/{id}", [RequirementsController::class, "category_update"])->name("requirements.category_update");
    Route::delete("/categoria/{id}/eliminar", [RequirementsController::class, "category_delete"])->name("requirements.category_delete");
});

// * Proyectos
Route::prefix('proyectos')->middleware(["auth"])
    ->middleware("can:project.index")
    ->group(function () {
        // * index proyecto
        Route::get("/", [ProjectController::class, "index"])->name("project.index");

        Route::get(
            "/crear",
            [ProjectController::class, "create"]
        )->middleware("can:project.create")->name("project.create");

        Route::get(
            "/show/{slug_name}",
            [ProjectController::class, "show"]
        )->name("project.show");

        Route::get(
            "/editar/{project}",
            [ProjectController::class, "edit"]
        )->middleware("can:project.edit")->name("project.edit");

        Route::put(
            "/published/{project}",
            [ProjectController::class, "published"]
        )->middleware("can:project.published")->name("project.published");

        Route::post(
            "/store",
            [ProjectController::class, "store"]
        )->middleware("can:project.create")->name("project.store");

        Route::delete(
            "/delete/{project}",
            [ProjectController::class, "destroy"]
        )->middleware("can:project.destroy")->name("project.destroy");

        Route::delete(
            "/trash/{project}",
            [ProjectController::class, "trash"]
        )->middleware("can:project.destroy")->name("project.trash");

        Route::put(
            "/out_trash/{project}",
            [ProjectController::class, "out_trash"]
        )->middleware("can:project.edit")->name("project.out_trash");

        Route::post(
            "/upload_image",
            [ProjectController::class, "upload_image"]
        )->middleware("can:project.create")->name("project.upload_image");

        Route::delete(
            "/upload_image",
            [ProjectController::class, "upload_image_delete"]
        )->middleware("can:project.destroy")->name("project.upload_image_delete");

        Route::post(
            "/crear-actualizar",
            [ProjectController::class, "change_or_create_data_project"]
        )->middleware("can:project.create")->name("project.change_or_create_data_project");
    });

// * configuracion
Route::prefix("configuracion")
    ->middleware("auth")
    ->middleware("can:settings.index")
    ->group(function () {
        // * vista settings
        Route::get("/", [SettingController::class, "index"])->name("settings.index");

        // * subir imagen logo async
        Route::post("/upload_logo_async", [SettingController::class, "upload_logo_async"])
            ->name("settings.upload_logo_async");
        // * publicar logo async
        Route::post("/publish_logo_async", [SettingController::class, "publish_logo_async"])
            ->name("settings.publish_logo_async");

        // * subir imagen principal async
        Route::post("/upload_img_primary_async", [SettingController::class, "upload_img_primary_async"])
            ->name("settings.upload_img_primary_async");

        // * subir datos de informacion principal del sitio (async)
        Route::post("/info_primary_async", [SettingController::class, "info_primary_async"])
            ->name("settings.info_primary_async");
        Route::post("/published_info_primary_async", [SettingController::class, "published_info_primary_async"])
            ->name("settings.published_info_primary_async");

        // * subir info de contacto de la empresa (async)
        Route::post("/contact_info_async", [SettingController::class, "contact_info_async"])
            ->name("settings.contact_info_async");

        // * registro de redes sociales
        Route::post("/create_social_media_async", [SettingController::class, "create_social_media_async"])
            ->name("settings.create_social_media_async");

        // * actualizacion de redes sociales
        Route::put("/update_social_media_async/{social_media}", [SettingController::class, "update_social_media_async"])
            ->name("settings.update_social_media_async");

        // * eliminar redes sociales
        Route::delete("/delete_social_media_async/{social_media}", [SettingController::class, "delete_social_media_async"])
            ->name("settings.delete_social_media_async");

        // * get redes sociales
        Route::get("/get_social_media_async/{social_media}", [SettingController::class, "get_social_media_async"])
            ->name("settings.get_social_media_async");
    });


// * testimonios
Route::prefix("testimonios")
    ->middleware("auth")
    ->group(function () {
        // * vista testimonios
        Route::get("/", [TestimonyController::class, "index"])->name("testimony.index");

        // * vista de creacion de testimonio
        Route::get("/crear", [TestimonyController::class, "create"])->name("testimony.create");

        // * vista de actualizacion de testimonio
        Route::get("/editar/{testimony}", [TestimonyController::class, "edit"])->name("testimony.edit");

        // * Creacion de testimonio
        Route::post("/crear", [TestimonyController::class, "store"])->name("testimony.store");

        // * funcion async para publicar testimonio
        Route::put("/publicar/{testimony}", [TestimonyController::class, "published"])->name("testimony.published");

        // * funcion async para publicar testimonio
        Route::put("/acturalizar/{testimony}", [TestimonyController::class, "update"])->name("testimony.update");

        // * funcion async para actualizar el estatus del testimonio (en caso de que ya se halla enviado a alguien)
        Route::put("/acturalizar/{testimony}/estatus", [TestimonyController::class, "update_send"])->name("testimony.update_send");

        // * eliminar testimonio async
        Route::delete("/eliminar/{testimony}", [TestimonyController::class, "destroy"])->name("testimony.destroy");
    });

// * mensaje de agradacemiento testimonio
Route::get("/testimonio/{testimony}/show", [TestimonyController::class, "show"])->name("testimony.show");
Route::get("testimonio/mensaje", [TestimonyController::class, "message"])->name("testimony.message");
Route::get("testimonio/{token}", [TestimonyController::class, "with_token"])->name("testimony.token");

// * crear testimonio solicitado
Route::put("testimonio/{token}", [TestimonyController::class, "update_with_token"])->name("testimony.update_with_token");

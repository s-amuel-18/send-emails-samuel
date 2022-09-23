<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            // * usuario creador
            $table->bigInteger("user_id")->default(0)->index();

            // * nombre del proyecto.
            $table->string("name")->nullable();

            // * slug del proyecto (este es un nombre formateado teniendo en cuenta el name "nombre del proyecto") ejecm "mi-proyecto".
            $table->string("slug")->nullable();

            // * nos permite hacer publico un proyecto, esto solo muestra al publico o no los proyectos.
            $table->boolean("published")->default(0);

            // * esta imagen es una miniatura del proyecti
            $table->text("image_front_page")->nullable();

            // * descripcion del proeycto.
            $table->text("description")->nullable();

            // * campo de borrador que nos permite alojar registros que no se culminaron
            $table->boolean("eraser")->default(0);

            // * papelera
            $table->boolean("trash")->default(0);

            // * se debe crear una tabla pivote para alojar las categorias del proyecto

            // * se debe crear una tabla pivot para alojar las imagenes relacionadas en el proyecto

            // * se debe crear una table para alojar items de ayuda del proyecto 
            // ? estos items de ayuda nos serviran para adjuntar elementos necesarios para el proyecto

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}

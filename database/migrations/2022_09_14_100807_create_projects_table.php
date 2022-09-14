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
            $table->string("name");

            // * slug del proyecto (este es un nombre formateado teniendo en cuenta el name "nombre del proyecto") ejecm "mi-proyecto".
            $table->string("slug");

            // * nos permite hacer publico un proyecto, esto solo muestra al publico o no los proyectos.
            $table->boolean("published");

            // * esta imagen es una miniatura del proyecti
            $table->text("image_front_page")->nullable();

            // * descripcion del proeycto.
            $table->text("description");

            // * se debe crear una tabla pivote para alojar las categorias del proyecto

            // * se debe crear una tabla pivot para alojar las imagenes relacionadas en el proyecto

            // * se debe crear una table para alojar items de ayuda del proyecto 
            // ? estos items de ayuda nos serviran para adjuntar elementos necesarios para el proyecto


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

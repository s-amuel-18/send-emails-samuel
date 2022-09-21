<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ? usamos esta tabla para agregar categorias a un Project
        Schema::create('category_project', function (Blueprint $table) {
            $table->id();

            // * Proyecto asociado
            $table->bigInteger("project_id")->default(0)->index();

            // * categoria del proyecto
            $table->bigInteger("category_id")->default(0)->index();
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
        Schema::dropIfExists('project_category');
    }
}

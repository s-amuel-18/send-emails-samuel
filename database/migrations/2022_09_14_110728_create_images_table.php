<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ? esta tabla se usará para agregar imagenes a distintos registros de distintas tablas
        Schema::create('images', function (Blueprint $table) {
            $table->id();

            // * direccion de la imagen 
            $table->text("url");

            // * id del elemento al que pertenece la imagen
            $table->unsignedBigInteger("imageable_id");

            // * class php
            $table->string("imageable_type");
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
        Schema::dropIfExists('images');
    }
}

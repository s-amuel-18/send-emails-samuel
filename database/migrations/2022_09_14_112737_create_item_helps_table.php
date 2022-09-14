<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ? Esta tabla se crea para agregar informacion de ayusa a los registros que se le indiquen
        Schema::create('item_helps', function (Blueprint $table) {
            $table->id();

            // * nombre del item  
            $table->string("name");

            // * descripcion del item 
            $table->text("description");

            // * id del elemento al que pertenece el item
            $table->unsignedBigInteger("helpeable_id");

            // * class php
            $table->string("helpeable_type");

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
        Schema::dropIfExists('item_helps');
    }
}

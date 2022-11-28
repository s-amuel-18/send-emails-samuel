<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ? Esta tabla nos sirve para la creacion de notas o apuntes
        Schema::create('notes', function (Blueprint $table) {
            $table->id();

            // * usuario creador
            $table->bigInteger("user_id")->default(0)->index();
            $table->bigInteger("category_id")->default(0)->index();

            // * nombre de la nota
            $table->string("name")->nullable();

            // * descripcion de la nota
            $table->text("description")->nullable();

            // * papelera
            $table->boolean("trash")->default(0);

            // * favorito
            $table->boolean("favorite")->default(0);

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
        Schema::dropIfExists('notes');
    }
}

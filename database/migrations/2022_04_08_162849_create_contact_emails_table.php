<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_emails', function (Blueprint $table) {
            $table->id();

            $table->foreignId("user_id")->references("id")->on("users");
            $table->string("nombre_empresa")->nullable();
            $table->string("url")->nullable();
            $table->smallInteger("estado")->default(0);
            $table->string("email")->unique()->nullable();
            $table->string("whatsapp")->nullable();
            $table->string("instagram")->nullable();
            $table->string("facebook")->nullable();
            $table->text("descripcion")->nullable();

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
        Schema::dropIfExists('contact_emails');
    }
}

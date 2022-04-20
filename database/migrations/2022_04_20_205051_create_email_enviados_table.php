<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailEnviadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_enviados', function (Blueprint $table) {
            $table->id();

            $table->foreignId("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignId("contact_email_id")->references("id")->on("contact_emails")->onDelete("cascade");


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
        Schema::dropIfExists('email_enviados');
    }
}

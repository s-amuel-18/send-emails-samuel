<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToContactEmailUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_email_user', function (Blueprint $table) {
            // * tipo de email enviado, pueden ser:
            // * tipo mail, whatsapp, instagram, facebook
            // * esto lo hacemos para tener una separación de los contactos y a donde se han contactado
            $table->integer("type")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_email_user', function (Blueprint $table) {
            //
        });
    }
}

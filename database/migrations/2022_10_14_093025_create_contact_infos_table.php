<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->default(0)->index();
            $table->string("location")->nullable();
            $table->string("location_alt")->nullable();
            $table->string("phone_number")->nullable();
            $table->string("phone_number_alt")->nullable();
            $table->string("email")->unique()->nullable();
            $table->string("email_alt")->unique()->nullable();
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
        Schema::dropIfExists('contact_infos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // - pays: id - user-id - image - name - description - payment_amount - type  
        // * registros de pagos (deudas o prestamos)
        Schema::create('pays', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("user_id")->default(0)->index();

            $table->string("name")->nullable();

            $table->float("payment_amount")->default(0);

            $table->text("image_url")->nullable();

            $table->text("description")->nullable();

            $table->tinyInteger("type")->default(0);

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
        Schema::dropIfExists('pays');
    }
}

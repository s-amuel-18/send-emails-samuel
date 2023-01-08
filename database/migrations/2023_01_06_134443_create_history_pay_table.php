<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryPayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // - history_pays: id - user-id - pay-id - count-pay - payment_amount - type
    public function up()
    {
        // * historial de pagos
        Schema::create('history_pay', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("user_id")->default(0)->index();

            // $table->bigInteger("pay_id")->default(0)->index();

            $table->float("payment_amount")->default(0);

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
        Schema::dropIfExists('history_pay');
    }
}

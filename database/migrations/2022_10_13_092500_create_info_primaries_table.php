<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoPrimariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_primaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->default(0)->index();
            $table->text("url")->nullable();
            $table->string("title")->nullable();
            $table->text("description")->nullable();
            $table->boolean("published")->default(0);
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
        Schema::dropIfExists('info_primaries');
    }
}

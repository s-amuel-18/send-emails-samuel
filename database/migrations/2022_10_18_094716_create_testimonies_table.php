<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimoniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonies', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->nullable();

            $table->string("token")->nullable();

            $table->bigInteger("user_id")->default(0)->index();

            $table->bigInteger("image_id")->default(0)->index();

            $table->string("name")->nullable();

            $table->string("position")->nullable();

            $table->tinyInteger('rating')->nullable();

            $table->string('title')->nullable();

            $table->text('review')->nullable();

            $table->boolean('published')->default(0);

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
        Schema::dropIfExists('testimonies');
    }
}

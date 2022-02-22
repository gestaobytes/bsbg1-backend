<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 30);
            $table->string('title', 50);
            $table->string('slug', 60);
            $table->string('icon', 250)->nullable();
            $table->integer('order')->nullable();
            $table->string('description', 250);
            $table->string('topcolor', 30)->nullable();
            $table->string('colorsourcetop', 30)->nullable();
            $table->boolean('linktop');
            $table->boolean('linkfooter');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->string('description', 200);
            $table->string('standardfontcolor', 30);
            $table->string('colortop', 30);
            $table->string('colorsourcetop', 30);
            $table->string('colorfooter', 30);
            $table->string('colorsourcefooter', 30);
            $table->string('status', 15);
            $table->string('image', 50);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layouts');
    }
}

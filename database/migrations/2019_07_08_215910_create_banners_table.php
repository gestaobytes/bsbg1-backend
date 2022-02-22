<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('positionbanner_id')->unsigned();
            $table->foreign('positionbanner_id')->references('id')->on('position_banners')->onDelete('cascade');
            $table->string('url', 120);
            $table->integer('order');
            $table->date('start');
            $table->date('end');
            $table->string('name', 120);
            $table->longText('image');
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
        Schema::dropIfExists('banners');
    }
}

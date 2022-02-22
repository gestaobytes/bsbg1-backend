<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('websitename', 120);
            $table->string('toplogo', 30);
            $table->string('logofooter', 30);
            $table->string('favicon', 30);
            $table->string('metatitle', 120);
            $table->string('metadescription', 255);
            $table->string('metakeywords', 255);
            $table->string('termsofuse', 120);
            $table->text('codgoogle');
            $table->string('urlapp', 30);
            $table->string('passwordapp', 120);
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
        Schema::dropIfExists('settings');
    }
}

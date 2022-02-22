<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigBehaviorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_behaviors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('urlmethod', 120);
            $table->char('votewithoutregistration', 3);
            $table->char('selfapproval', 3);
            $table->char('autolistinghome', 3);
            $table->char('autoloadconfig', 3);
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
        Schema::dropIfExists('config_behaviors');
    }
}

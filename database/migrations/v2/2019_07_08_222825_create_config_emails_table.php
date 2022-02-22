<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address', 150);
            $table->string('driver', 20);
            $table->string('host', 50);
            $table->string('port', 5);
            $table->string('username', 150);
            $table->string('password', 150);
            $table->string('encryption', 5);
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
        Schema::dropIfExists('config_emails');
    }
}

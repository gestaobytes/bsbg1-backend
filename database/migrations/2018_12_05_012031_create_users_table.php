<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('registration', 20);
            $table->string('name', 80);
            $table->char('genre', 1)->nullable();
            // $table->date('birthday')->nullable();
            $table->string('cpf', 14)->nullable();
            $table->string('rg', 18)->nullable();
            $table->longText('image', 30)->nullable();
            $table->string('status', 10);
            $table->string('phone', 14)->nullable();
            $table->string('cellphone', 14);
            $table->string('cellphone2', 14)->nullable();
            $table->string('email', 255);
            $table->string('password', 100);
            $table->string('type', 20);
            $table->rememberToken();

            $table->timestamps();
            $table->softDeletes();
        });

        /** inalterado a partir daqui*/

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('label', 500);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('label', 500);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('permission_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('users');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
}

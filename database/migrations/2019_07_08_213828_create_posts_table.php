<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subcategory_id')->unsigned();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->integer('position_id')->unsigned();
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('retracts', 60);
            $table->string('title', 180);
            $table->string('titleadapter', 180);
            $table->string('slug', 256);
            $table->string('subtitle', 256);
            $table->longText('text');
            $table->longText('image')->nullable();
            $table->string('image_credit', 60)->nullable();
            $table->string('image_subtitle', 256)->nullable();
            $table->string('tags', 256);
            $table->boolean('status');
            $table->date('date_start');
            $table->boolean('will_restrict_users');
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
        Schema::dropIfExists('posts');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fantasy_name', 200);
            $table->string('social_reason', 200);
            $table->string('country_insc', 20);
            $table->string('state_insc', 20);
            $table->string('cnpj', 20);
            $table->string('address', 200);
            $table->string('city', 120);
            $table->char('uf', 2);
            $table->string('cep', 15);
            $table->string('phone', 14);
            $table->string('logo', 50);
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
        Schema::dropIfExists('companies');
    }
}

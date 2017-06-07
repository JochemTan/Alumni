<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
             $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('postalcode');
            $table->string('longtitude');
            $table->string('latitude');
            $table->string('province');
            $table->string('place');
            $table->string('muncipality');
            $table->string('sector'); // in welke sector werkt een bedrijf
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
        Schema::drop('company');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('alumnus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('insertion');
            $table->string('lastname');
            $table->enum('sex', ['male', 'female','other']);
            $table->string('postalcode');
            $table->string('email')->unique();
            $table->date('birthday');
            $table->string('hash');
            $table->string('function');
            $table->string('profile_image');
            $table->string('education');
            $table->integer('graduationYear');
            $table->string('linkedIn')->nullable();
            $table->string('province');
            $table->string('place');
            $table->string('muncipality');
            $table->string('longtitude');
            $table->string('latitude');
            $table->string('salary')->nullable();
            $table->integer('company_id')->nullable()->unsigned();
            $table->integer('group_id');
            $table->boolean('guestlecture');
            $table->boolean('newsletter');
            $table->boolean('prive');
            $table->rememberToken();
            $table->timestamp('last_visited');
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
        Schema::drop('alumnus');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $table = 'users';
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {       
            $table->increments('id');
            $table->string('firstname');
            $table->string('insertion')->nullable();
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('jobTitle')->nullable();
            $table->integer('role_id')->unsigned();
            $table->integer('collection_id')->nullable()->unsigned();
            $table->rememberToken();
            $table->timestamps();

            // foreign keys
            // $table->foreign('collection_id')->references('id')->on('collection');
            // $table->foreign('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}

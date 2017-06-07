<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnusGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnus_group', function (Blueprint $table) {
            $table->integer('alumnus_id')->unsigned()->index();
            $table->foreign('alumnus_id')->references('id')->on('alumnus')->onDelete('cascade');

            $table->integer('group_id')->unsigned()->index();
            $table->foreign('group_id')->references('id')->on('group')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alumnus_group');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignkeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alumnus', function ($table) {

            $table->foreign('company_id')->references('id')->on('company');
        });

        Schema::table('group', function ($table) {
            $table->foreign('collection_id')->references('id')->on('collection');
        });

        Schema::table('settings', function ($table) {
            $table->foreign('alumnus_id')->references('id')->on('alumnus');
        });

        Schema::table('users', function ($table) {
            $table->foreign('role_id')->references('id')->on('role');
            $table->foreign('collection_id')->references('id')->on('collection');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumnus', function ($table) {

            $table->dropForeign('alumnus_company_id_foreign');
        });

        Schema::table('group', function ($table) {
            $table->dropForeign('group_collection_id_foreign');
        });

        Schema::table('settings', function ($table) {
            $table->dropForeign('settings_alumnus_id_foreign');
        });

        Schema::table('users', function ($table) {
            $table->dropForeign('users_role_id_foreign');
            $table->dropForeign('users_collection_id_foreign');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles_description', function (Blueprint $table) {
            $table->foreign('fk_role_id')->references('role_id')->on('roles')->onDelete('cascade');
            $table->foreign('fk_language_id')->references('language_id')->on('languages')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('fk_role_id')->references('role_id')->on('roles')->onDelete(null);
        });

        Schema::table('pages_description', function (Blueprint $table) {
            $table->foreign('fk_page_id')->references('page_id')->on('pages')->onDelete('cascade');
            $table->foreign('fk_language_id')->references('language_id')->on('languages')->onDelete('cascade');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->foreign('fk_type_id')->references('type_id')->on('types')->onDelete(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}

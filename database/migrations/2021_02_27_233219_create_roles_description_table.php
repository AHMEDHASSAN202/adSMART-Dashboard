<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_description', function (Blueprint $table) {
            $table->id('role_description_id');
            $table->unsignedBigInteger('fk_role_id');
            $table->unsignedBigInteger('fk_language_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('fk_role_id')->references('role_id')->on('roles')->onDelete('cascade');
            $table->foreign('fk_language_id')->references('language_id')->on('languages')->onDelete(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_description');
    }
}

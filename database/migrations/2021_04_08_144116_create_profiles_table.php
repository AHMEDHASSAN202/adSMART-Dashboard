<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_user_id');
            $table->string('user_phone')->unique()->nullable();
            $table->foreignId('fk_user_country')->nullable();
            $table->string('user_address')->nullable();
            $table->timestamps();

            $table->foreign('fk_user_id')->references('user_id')->on('users')->cascadeOnDelete();
            $table->foreign('fk_user_country')->references('flag_id')->on('flags')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}

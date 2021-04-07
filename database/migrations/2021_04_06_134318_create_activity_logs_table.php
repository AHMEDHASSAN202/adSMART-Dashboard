<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('device');
            $table->string('platform');
            $table->string('browser');
            $table->string('ip_address');
            $table->string('auth_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('user_activity');
            $table->string('user_activity_desc')->nullable();
            $table->string('model_id')->nullable();
            $table->string('model_type')->nullable();
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
        Schema::dropIfExists('activity_logs');
    }
}

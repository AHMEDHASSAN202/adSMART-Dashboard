<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_description', function (Blueprint $table) {
            $table->id('page_description_id');
            $table->foreignId('fk_page_id');
            $table->foreignId('fk_language_id');
            $table->string('page_slug')->unique();
            $table->string('page_title');
            $table->text('page_content');
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
        Schema::dropIfExists('pages_description');
    }
}

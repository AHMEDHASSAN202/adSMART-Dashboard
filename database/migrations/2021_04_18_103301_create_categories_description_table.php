<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_description', function (Blueprint $table) {
            $table->id('categories_description_id');
            $table->foreignId('fk_category_id');
            $table->foreignId('fk_language_id');
            $table->string('category_name');
            $table->string('category_slug');
            $table->text('category_description');
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
        Schema::dropIfExists('categories_description');
    }
}

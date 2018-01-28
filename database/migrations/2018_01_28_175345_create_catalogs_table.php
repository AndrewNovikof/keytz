<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('user_id');
            $table->boolean('is_public')->default('false');
            $table->timestamps();
        });

        Schema::create('book_catalog', function (Blueprint $table) {
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('catalog_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogs');
        Schema::dropIfExists('book_catalog');
    }
}

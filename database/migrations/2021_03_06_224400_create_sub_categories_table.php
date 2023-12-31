<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();;
            $table->unsignedBigInteger('age_id')->nullable(); //NOT WORKING YET
            $table->unsignedBigInteger('color_id')->nullable(); //NOT WORKING YET
            $table->unsignedBigInteger('size_id')->nullable();
            $table->unsignedBigInteger('clothes_category_id')->nullable();
            $table->unsignedBigInteger('shop_category_id');
            $table->unsignedBigInteger('category_id')->nullable();
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
        Schema::dropIfExists('sub_categories');
    }
}

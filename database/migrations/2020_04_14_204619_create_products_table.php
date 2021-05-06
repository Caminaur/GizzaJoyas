<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name', 50);
          $table->integer('price');
          $table->boolean('onSale')->default(false);
          $table->integer('discount')->nullable();
          $table->longText('description')->nullable();
          $table->string('model', 50)->nullable();

          $table->bigInteger('gender_id')->unsigned()->nullable();
          $table->foreign('gender_id')->references('id')->on('genders')->onDelete('set null')->onUpdate('cascade');

          $table->bigInteger('category_id')->unsigned()->nullable();
          $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');

          $table->bigInteger('brand_id')->unsigned()->nullable();
          $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null')->onUpdate('cascade');

          $table->bigInteger('material_id')->unsigned()->nullable();
          $table->foreign('material_id')->references('id')->on('materials')->onDelete('set null')->onUpdate('cascade');

          $table->bigInteger('age_id')->unsigned()->nullable();
          $table->foreign('age_id')->references('id')->on('ages')->onDelete('set null')->onUpdate('cascade');

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
        Schema::dropIfExists('products');
    }
}

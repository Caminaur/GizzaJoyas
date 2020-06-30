<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('product_tags', function (Blueprint $table) {
          $table->bigIncrements('id');

          $table->bigInteger('tag_id')->unsigned()->nullable();
          $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');

          $table->bigInteger('product_id')->unsigned()->nullable();
          $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

          $table->boolean('hasTag');

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
        Schema::dropIfExists('product_tags');
    }
}

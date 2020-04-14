<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('quantity')->nullable();

          $table->bigInteger('product_id')->nullable()->unsigned();
          $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

          $table->bigInteger('size_id')->nullable()->unsigned();
          $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade')->onUpdate('cascade');

          $table->bigInteger('color_id')->nullable()->unsigned();
          $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('stocks');
    }
}

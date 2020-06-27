<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('size_id')->nullable();
          $table->bigInteger('quantity')->nullable();
          $table->unsignedBigInteger('user_id')->nullable();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $table->unsignedBigInteger('product_id')->nullable();
          $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('carts');
    }
}

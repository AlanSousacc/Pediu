<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeioameioItemCartTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('meioameio_item_cart', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('cart_id')->unsigned();
      $table->unsignedBigInteger('produto_id');
      $table->unsignedBigInteger('empresa_id')->unsigned();
      $table->unsignedBigInteger('cartitems_id')->nullable();
      $table->timestamps();

      $table->foreign('cart_id')->references('id')->on('cart')->onDelete('cascade');
      $table->foreign('produto_id')->references('id')->on('produtos');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->foreign('cartitems_id')->references('id')->on('cart_items')->onDelete('cascade');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('meioameio_item_cart');
  }
}

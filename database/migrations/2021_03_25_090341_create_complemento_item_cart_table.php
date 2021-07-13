<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplementoItemCartTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('complemento_item_cart', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('cart_id')->unsigned();
      $table->unsignedBigInteger('produto_id');
      $table->unsignedBigInteger('complemento_id')->unsigned();
      $table->unsignedBigInteger('empresa_id')->unsigned();
      $table->unsignedBigInteger('cartitems_id')->nullable();

      $table->foreign('cart_id')->references('id')->on('cart')->onDelete('cascade');
      $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
      $table->foreign('complemento_id')->references('id')->on('complementos')->onDelete('cascade');
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
    Schema::dropIfExists('complemento_item_cart');
  }
}

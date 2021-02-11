<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('cart_items', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('cart_id')->unsigned();
      $table->unsignedBigInteger('produto_id');
      $table->unsignedBigInteger('user_id')->unsigned();
      $table->unsignedBigInteger('empresa_id')->unsigned();
      $table->double('preco', 5,2);
      $table->integer('qtde');
      $table->timestamps();

      $table->foreign('cart_id')->references('id')->on('cart')->onDelete('cascade');
      $table->foreign('produto_id')->references('id')->on('produtos');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('cart_items');
  }
}

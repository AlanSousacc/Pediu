<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoProdutoTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('pedido_produto', function (Blueprint $table) {
      $table->integer('qtde');
      $table->text('obsitem')->nullable();
      $table->double('prvenda',5,2);
      $table->unsignedBigInteger('produto_id');
      $table->unsignedBigInteger('pedido_id');
      
      $table->foreign('pedido_id')->references('id')->on('pedidos');
      $table->foreign('produto_id')->references('id')->on('produtos');
    });
  }
  
  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('pedido_produto');
  }
}

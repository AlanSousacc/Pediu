<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplementoItemPedidoTable extends Migration
{
  public function up()
  {
    Schema::create('complemento_item_pedido', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('pedido_id')->unsigned();
      $table->unsignedBigInteger('produto_id');
      $table->unsignedBigInteger('complemento_id')->unsigned();
      $table->unsignedBigInteger('empresa_id')->unsigned();

      $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
      $table->foreign('produto_id')->references('id')->on('produtos');
      $table->foreign('complemento_id')->references('id')->on('complementos')->onDelete('cascade');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
    });
  }

  public function down()
  {
    Schema::dropIfExists('complemento_item_pedido');
  }
}

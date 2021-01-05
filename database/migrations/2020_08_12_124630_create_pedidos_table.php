<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('pedidos', function (Blueprint $table) {
      $table->id();
      $table->string('observacao', 50)->nullable();
      $table->double('desconto', 5,2);
      $table->double('subtotal', 5,2);
      $table->double('total', 5,2);
      $table->enum('local_pagamento', ['Balcao', 'Local de entrega', 'Mesa']);
      $table->enum('forma_pagamento', ['Dinheiro', 'Cartão de Crédito', 'Cartão de Débito', 'Conta do Cliente']);
      $table->unsignedBigInteger('contato_id');
      $table->unsignedBigInteger('endereco_id');
      $table->unsignedBigInteger('entregador_id')->nullable();
      $table->integer('statusentrega');
      $table->double('valortroco', 5,2)->nullable();
      $table->timestamps();

      $table->foreign('contato_id')->references('id')->on('contatos')->onDelete('cascade');
      $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
      $table->foreign('entregador_id')->references('id')->on('entregadores')->onDelete('cascade');
    });
  }
  
  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('pedidos');
  }
}

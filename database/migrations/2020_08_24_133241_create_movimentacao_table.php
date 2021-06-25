<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentacaoTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('movimentacao', function (Blueprint $table) {
      $table->id();
      $table->enum('tipo', ['Entrada', 'Saída']);
      $table->enum('forma_pagamento', ['Dinheiro', 'Cartão de Crédito', 'Cartão de Débito', 'Conta do Cliente']);
      $table->double('valortotal', 10, 2);
      $table->double('valorrecebido', 10, 2);
      $table->double('valorpendente', 10, 2);
      $table->boolean('status');
      $table->unsignedBigInteger('pedido_id')->nullable();
      $table->unsignedBigInteger('contato_id')->nullable();
      $table->timestamps();

      $table->foreign('contato_id')->references('id')->on('contatos')->onDelete('cascade');
      $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
    });
  }
  
  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('movimentacao');
  }
}

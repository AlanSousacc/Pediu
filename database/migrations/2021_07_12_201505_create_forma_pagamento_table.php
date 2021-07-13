<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormaPagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forma_pagamento', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('empresa_id')->unsigned();
          $table->string('descricao', 30);
          $table->boolean('tipo_recebimento')->default(0); // 0 -> Realizado | 1 -> Realizar
          $table->integer('parcelas');
          $table->boolean('status')->default(1); // 0 -> Cadastro Inativo | 1 -> Cadastro Ativo
          $table->timestamps();

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
        Schema::dropIfExists('forma_pagamento');
    }
}

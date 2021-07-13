<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigPagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_pagamento', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('empresa_id')->unsigned();
          $table->unsignedBigInteger('tipo_movimento_id')->unsigned(); // Origem da transação (Venda, Compra, Pagamento Avulso, etc)
          $table->unsignedBigInteger('forma_pagamento_id')->unsigned(); // (Dinheiro, Cartão, Crediário, Pix, etc)
          $table->boolean('status')->default(1); // 0 -> Permissão negada | 1 -> Permissão Concedida
          $table->timestamps();

          $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
          $table->foreign('tipo_movimento_id')->references('id')->on('tipo_movimento')->onDelete('cascade');
          $table->foreign('forma_pagamento_id')->references('id')->on('forma_pagamento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_pagamento');
    }
}

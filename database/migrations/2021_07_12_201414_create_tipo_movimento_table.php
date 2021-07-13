<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoMovimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*
        1 - Venda
        2 - Recebimento
        3 - Compra
        4 - Pagamento
        5 - Recebimento Avulso
        6 - Pagamento Avulso
      */
        Schema::create('tipo_movimento', function (Blueprint $table) {
          $table->id();
          $table->string('descricao', 30);
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
        Schema::dropIfExists('tipo_movimento');
    }
}

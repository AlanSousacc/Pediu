<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaturamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturamento', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('empresa_id')->unsigned();
          $table->unsignedBigInteger('user_id')->unsigned();
          $table->unsignedBigInteger('tipo_movimento_id')->unsigned(); // Origem da transação (Venda, Compra, Pagamento Avulso, etc)
          $table->date('dtmovimento');
          // $table->date('dtvenc');
          $table->double('total');
          $table->timestamps();

          $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('tipo_movimento_id')->references('id')->on('tipo_movimento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faturamento');
    }
}

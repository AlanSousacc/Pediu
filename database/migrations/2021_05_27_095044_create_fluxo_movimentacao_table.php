<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFluxoMovimentacaoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('fluxo_movimentacao', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('movimentacao_id')->unsigned();
      $table->enum('tipo', ['Pagamento', 'Recebimento']);
      $table->enum('forma_movimentacao', ['Dinheiro', 'Cartão de Crédito', 'Cartão de Débito']);
      $table->double('valortotal', 10, 2);
      $table->double('valor', 10, 2);
      $table->unsignedBigInteger('empresa_id')->unsigned();
      $table->timestamps();

      $table->foreign('movimentacao_id')->references('id')->on('movimentacao')->onDelete('cascade');
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
    Schema::dropIfExists('fluxo_movimentacao');
  }
}

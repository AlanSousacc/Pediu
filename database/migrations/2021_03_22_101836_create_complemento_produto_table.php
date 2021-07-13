<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplementoProdutoTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('complemento_produto', function (Blueprint $table) {
      $table->double('preco',5,2);
      $table->unsignedBigInteger('produto_id');
      $table->unsignedBigInteger('complemento_id');

      $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
      $table->foreign('complemento_id')->references('id')->on('complementos')->onDelete('cascade');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('complemento_produto');
  }
}

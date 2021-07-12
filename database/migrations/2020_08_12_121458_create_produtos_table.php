<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('produtos', function (Blueprint $table) {
      $table->id();
      $table->string('descricao', 50);
      $table->text('composicao');
      $table->double('precocusto', 5,2)->nullable();
      $table->double('precovenda', 5,2);
      $table->boolean('status')->default(1);
      $table->string('foto')->default('default.png')->nullable();
      $table->boolean('controlatamanho')->default(0);
      $table->double('precopequeno', 5,2)->nullable();
      $table->double('precomedio', 5,2)->nullable();
      $table->double('precogrande', 5,2)->nullable();
      $table->boolean('saboresdiversos')->default(0);
      $table->unsignedBigInteger('grupo_id')->nullable();
      $table->unsignedBigInteger('empresa_id')->unsigned();
      $table->timestamps();
      
			$table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('produtos');
  }
}

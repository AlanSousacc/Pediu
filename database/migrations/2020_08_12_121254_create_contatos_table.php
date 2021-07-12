<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContatosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('contatos', function (Blueprint $table) {
      $table->id();
      $table->string('nome', 60);
      $table->string('documento', 30)->nullable();
      $table->string('telefone', 20);
      $table->enum('tipo', ['Cliente', 'Fornecedor']);
      $table->boolean('ativo')->default(1);
      $table->unsignedBigInteger('empresa_id')->unsigned();
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
    Schema::dropIfExists('contatos');
  }
}

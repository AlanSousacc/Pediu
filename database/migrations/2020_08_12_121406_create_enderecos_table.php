<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('enderecos', function (Blueprint $table) {
      $table->id();
      $table->string('endereco', 50);
      $table->string('numero', 7);
      $table->string('bairro', 20);
      $table->string('cidade', 30);
      $table->string('observacao', 255)->nullable();
      $table->string('cep', 20)->nullable();
      $table->string('telefone_entrega', 20)->nullable();
      $table->boolean('status')->default(1);
      $table->boolean('principal');
      $table->unsignedBigInteger('contato_id');
      $table->unsignedBigInteger('empresa_id')->unsigned();
      $table->timestamps();
      
			$table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->foreign('contato_id')->references('id')->on('contatos')->onDelete('cascade');
    });
  }
  
  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('enderecos');
  }
}

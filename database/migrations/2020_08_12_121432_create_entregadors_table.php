<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregadorsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('entregadores', function (Blueprint $table) {
      $table->id();
      $table->string('nome', 60);
      $table->string('endereco', 50)->nullable();
      $table->string('numero', 5)->nullable();
      $table->string('cidade', 30)->nullable();
      $table->string('bairro', 20)->nullable();
      $table->string('telefone', 20);
      $table->string('cep', 15)->nullable();
      $table->enum('veiculo', ['Carro', 'Moto', 'Bicicleta', 'Nenhum']);
      $table->string('placa', 15)->nullable();
      $table->boolean('status')->default(1);
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
    Schema::dropIfExists('entregadores');
  }
}

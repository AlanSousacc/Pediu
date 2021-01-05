<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('cliente', function (Blueprint $table) {
      $table->id();
      $table->string('nome', 80);
      $table->string('cidade', 30);
      $table->string('endereco', 60);
      $table->string('numero', 5);
      $table->string('bairro', 15);
      $table->string('celular', 15);
      $table->string('razao', 30);
      $table->string('fantasia', 30);
      $table->string('cnpj', 20);
      $table->string('email', 100);
      $table->string('telefone', 20)->nullable();
      $table->string('logo')->default('default.jpg')->nullable();
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
    Schema::dropIfExists('cliente');
  }
}

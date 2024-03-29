<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('empresas', function (Blueprint $table) {
      $table->id();
      $table->string('uuid')->unique();
      $table->string('razao', 30);
      $table->string('fantasia', 30);
      $table->string('celular', 15);
      $table->string('nome', 80);
      $table->string('cidade', 30);
      $table->string('endereco', 60);
      $table->string('numero', 5);
      $table->string('bairro', 15);
      $table->string('cnpj')->unique();
      $table->string('email')->unique();
      $table->string('logo')->default('default.png')->nullable();
      $table->string('slug', 30)->unique()->nullable();
      $table->integer('plano');
      $table->unsignedBigInteger('cliente_id')->nullable();
      $table->enum('active', ['S', 'N'])->default('S');

      $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');

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
    Schema::dropIfExists('empresas');
  }
}

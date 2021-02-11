<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecoUsersTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('endereco_users', function (Blueprint $table) {
      $table->id();
      $table->string('endereco', 120);
      $table->string('numero', 6);
      $table->string('bairro', 60);
      $table->string('cidade', 70);
      $table->string('telefone', 30);
      $table->boolean('principal');
      $table->unsignedBigInteger('user_id')->unsigned();
      $table->unsignedBigInteger('empresa_id')->unsigned();
      $table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
    Schema::dropIfExists('endereco_users');
  }
}

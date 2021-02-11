<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('cart', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id')->unsigned();
      $table->unsignedBigInteger('empresa_id')->unsigned();
      $table->string('numberorder');
      $table->string('formapagamento');
      $table->string('statuspedido');
      $table->string('observacaopedido')->nullable();
      $table->double('valortroco', 5,2)->nullable();
      $table->double('valorentrega', 5,2)->nullable();
      $table->double('totalpedido', 5,2)->nullable();
      $table->double('subtotalpedido', 5,2)->nullable();
      $table->unsignedBigInteger('endereco_users_id')->unsigned();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->foreign('endereco_users_id')->references('id')->on('endereco_users')->onDelete('cascade');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('cart');
  }
}

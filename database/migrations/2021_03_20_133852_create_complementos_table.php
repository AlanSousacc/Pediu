<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplementosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('complementos', function (Blueprint $table) {
      $table->id();
      $table->string('descricao', 50);
      $table->double('preco', 5,2)->default(0.00);
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
    Schema::dropIfExists('complementos');
  }
}

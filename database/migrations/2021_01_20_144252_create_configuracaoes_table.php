<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracaoesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('configuracaoes', function (Blueprint $table) {
      $table->id();
      $table->boolean('controlaentrega')->default(1);
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
    Schema::dropIfExists('configuracaoes');
  }
}

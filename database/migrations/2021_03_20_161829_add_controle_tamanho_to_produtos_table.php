<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddControleTamanhoToProdutosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::table('produtos', function (Blueprint $table) {
      $table->boolean('controlatamanho')->default(0);
      $table->double('precopequeno', 5,2)->nullable();
      $table->double('precomedio', 5,2)->nullable();
      $table->double('precogrande', 5,2)->nullable();
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::table('produtos', function (Blueprint $table) {
      //
    });
  }
}

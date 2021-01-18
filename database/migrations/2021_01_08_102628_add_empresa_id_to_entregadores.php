<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmpresaIdToEntregadores extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::table('entregadores', function (Blueprint $table) {
      $table->unsignedBigInteger('empresa_id')->unsigned();
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
    Schema::table('entregadores', function (Blueprint $table) {
      //
    });
  }
}

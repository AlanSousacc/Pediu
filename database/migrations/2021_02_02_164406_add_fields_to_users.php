<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsers extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->string('telefone', 30)->nullable();
      $table->string('cidade', 30)->nullable();
      $table->string('endereco', 60)->nullable();
      $table->string('numero', 5)->nullable();
      $table->string('bairro', 15)->nullable();
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      //
    });
  }
}

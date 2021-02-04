<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValorentregaToConfiguracaoes extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::table('configuracaoes', function (Blueprint $table) {
      $table->double('valorentrega', 5,2)->default(0.00);
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::table('configuracaoes', function (Blueprint $table) {
      //
    });
  }
}

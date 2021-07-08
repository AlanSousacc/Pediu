<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsCozinhaTempopreparoToConfiguracaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuracaoes', function (Blueprint $table) {
            $table->boolean('controlecozinha')->default(0);
            $table->string('tempomediopreparo', 10);
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

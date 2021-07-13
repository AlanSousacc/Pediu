<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuxFaturamentoLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aux_faturamento_log', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('aux_faturamento_id')->unsigned();
          $table->unsignedBigInteger('forma_pagamento_id')->unsigned();
          $table->date('dtpagamento');
          $table->date('dtvencimento');
          $table->double('valorfatura');
          $table->double('valorpago');
          $table->double('valorrestante');
          $table->timestamps();

          $table->foreign('aux_faturamento_id')->references('id')->on('aux_faturamento')->onDelete('cascade');
          $table->foreign('forma_pagamento_id')->references('id')->on('forma_pagamento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aux_faturamento_log');
    }
}

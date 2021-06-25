<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPedidoprodutoIdToMeioameioItemPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meioameio_item_pedido', function (Blueprint $table) {
            $table->unsignedBigInteger('pedidoproduto_id')->nullable();
            $table->foreign('pedidoproduto_id')->references('id')->on('pedido_produto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meioameio_item_pedido', function (Blueprint $table) {
            //
        });
    }
}

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
      $table->boolean('controlepedidosbalcao')->default(1);
      $table->double('valorentrega', 5,2)->default(0.00);
      $table->string('tempominimoentrega')->default('25 á 40 minutos');
      $table->unsignedBigInteger('empresa_id')->unsigned();
      $table->string('statusrecebido', 1000)->default('🔔 Olá, informamos que recebemos o seu pedido, assim que começarmos a prepara-lo fazemos questão de avisar, agradecemos a preferência.');
      $table->string('statuspreparando', 1000)->default('🍕 🍔 🍟 Estamos preparando o seu pedido, em alguns minutos ele sairá para entrega, e avisaremos aqui.');
      $table->string('statusentregando', 1000)->default('🛵 O seu pedido está a caminho.');
      $table->string('statusentregue', 1000)->default('✔ Pedido entregue! Obrigado pela preferência.');
      $table->string('statuscancelado', 1000)->default('❌ OPS! Seu pedido foi cancelado, entre em contato pelo número do whatsapp para mais informações. 📞');

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

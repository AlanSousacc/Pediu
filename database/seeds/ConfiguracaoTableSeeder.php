<?php

use App\Models\Configuracao;
use Illuminate\Database\Seeder;

class ConfiguracaoTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    Configuracao::truncate();

    Configuracao::create([
      'empresa_id' => 1,
      'controlaentrega' => 1,
      'controlepedidosbalcao' => 1,
      'tempominimoentrega' => '25 á 40 minutos',
      ]);
  }
}

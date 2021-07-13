<?php

use App\Models\TipoMovimento;
use Illuminate\Database\Seeder;

class TipoMovimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     /*
        1 - Venda
        2 - Recebimento
        3 - Compra
        4 - Pagamento
        5 - Recebimento Avulso
        6 - Pagamento Avulso
    */

    public function run()
    {
      TipoMovimento::create([
        'descricao' => 'Venda',
      ]);
      TipoMovimento::create([
        'descricao' => 'Recebimento',
      ]);
      TipoMovimento::create([
        'descricao' => 'Compra',
      ]);
      TipoMovimento::create([
        'descricao' => 'Pagamento',
      ]);
      TipoMovimento::create([
        'descricao' => 'Recebimento Avulso',
      ]);
      TipoMovimento::create([
        'descricao' => 'Pagamento Avulso',
      ]);
    }
}

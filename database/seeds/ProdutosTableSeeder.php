<?php

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutosTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    Produto::truncate();

    Produto::create([
      'descricao' => 'Pizza Troiana',
      'composicao' => 'Pizza Troiana',
      'tipo' => 'Produto Final',
      'precocusto' => '10.00',
      'precovenda' => '23.50',
      'status' => '1',
      ]);

      Produto::create([
        'descricao' => 'Pizza Portuguesa',
        'composicao' => 'Pizza Portuguesa',
        'tipo' => 'Produto Final',
        'precocusto' => '10.00',
        'precovenda' => '25.90',
        'status' => '1',
        ]);
        
        Produto::create([
          'descricao' => 'Bolo de Fubá com Morango',
          'composicao' => 'Bolo de Fubá com Morango',
          'tipo' => 'Produto Final',
          'precocusto' => '3.00',
          'precovenda' => '10.50',
          'status' => '1',
          ]);
          
          Produto::create([
            'descricao' => 'Salgado Assado',
            'composicao' => 'Salgado Assado',
            'tipo' => 'Produto Final',
            'precocusto' => '2.4',
            'precovenda' => '3.50',
            'status' => '1',
            ]);
            
            Produto::create([
              'descricao' => 'Lanche X-Burguer',
              'composicao' => 'Lanche X-Burguer',
              'tipo' => 'Produto Final',
              'precocusto' => '12.00',
              'precovenda' => '15.50',
              'status' => '1',
              ]);
              
              Produto::create([
                'descricao' => 'Produto adicional',
                'composicao' => 'Produto adicional',
                'tipo' => 'Adicional',
                'precocusto' => '2.00',
                'precovenda' => '3.50',
                'status' => '1',
                ]);
                
                Produto::create([
                  'descricao' => 'Coca Cola 2L',
                  'composicao' => 'Coca Cola 2L',
                  'tipo' => 'Produto Final',
                  'precocusto' => '7.00',
                  'precovenda' => '9.50',
                  'status' => '1',
                  ]);
                  
                  Produto::create([
                    'descricao' => 'Coca Cola 600ml',
                    'composicao' => 'Coca Cola 600ml',
                    'tipo' => 'Produto Final',
                    'precocusto' => '4.00',
                    'precovenda' => '6.50',
                    'status' => '1',
                    ]);
                  }
                }
                
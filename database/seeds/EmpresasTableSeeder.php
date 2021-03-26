<?php

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresasTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    Empresa::truncate();

    Empresa::create([
      'uuid' => Str::uuid()->toString(),
      'razao' => 'ACPTI',
      'fantasia' => 'ACPTI',
      'celular' => '(16) 99179-3351',
      'nome' => 'Alan Wilian de Sousa',
      'cidade' => 'Sales Oliveira',
      'endereco' => 'Av: Mogiana',
      'numero' => '351',
      'bairro' => 'centro',
      'cnpj' => '85.758.178/0001-59',
      'email' => 'alansousa.cc@gmail.com',
      'logo' => 'default.png',
      'slug' => 'acpti',
      'cliente_id' => '',
      'active' => '1',
      ]);
    }
  }

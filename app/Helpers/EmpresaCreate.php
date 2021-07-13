<?php

namespace App\Helpers;

use App\Models\FormaPagamento;

class EmpresaCreate {
  
  public static function criaFormaPagamento($empresa_id)
  {
    FormaPagamento::create([
      'empresa_id'       => $empresa_id,
      'descricao'        => 'Dinheiro',
      'tipo_recebimento' => 0,
      'parcelas'         => 1,
      'status'           => 1,
    ]);
    FormaPagamento::create([
      'empresa_id'       => $empresa_id,
      'descricao'        => 'Cartão de Crédito',
      'tipo_recebimento' => 1,
      'parcelas'         => 3,
      'status'           => 1,
    ]);
    FormaPagamento::create([
      'empresa_id'       => $empresa_id,
      'descricao'        => 'Cartão de Débito',
      'tipo_recebimento' => 0,
      'parcelas'         => 1,
      'status'           => 1,
    ]);
    FormaPagamento::create([
      'empresa_id'       => $empresa_id,
      'descricao'        => 'Cheque',
      'tipo_recebimento' => 1,
      'parcelas'         => 1,
      'status'           => 1,
    ]);
    FormaPagamento::create([
      'empresa_id'       => $empresa_id,
      'descricao'        => 'Pix',
      'tipo_recebimento' => 0,
      'parcelas'         => 1,
      'status'           => 1,
    ]);
    FormaPagamento::create([
      'empresa_id'       => $empresa_id,
      'descricao'        => 'Crediário',
      'tipo_recebimento' => 1,
      'parcelas'         => 1,
      'status'           => 1,
    ]);
  }
}
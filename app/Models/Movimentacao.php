<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
  protected $fillable = ['tipo', 'forma_pagamento', 'valortotal', 'status', 'pedido_id', 'empresa_id', 'origem', 'cart_id', 'user_id', 'contato_id', 'observacao'];
  protected $table = 'movimentacao';

  public function pedido(){
    return $this->belongsTo('App\Models\Pedidos');
  }

  public function contato(){
    return $this->belongsTo(Contato::class, 'contato_id', 'id');
  }

  public function fluxomovimentacoes()
  {
    return $this->hasMany(FluxoMovimentacao::class, 'movimentacao_id', 'id');
  }

}

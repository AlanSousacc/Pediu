<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
  protected $fillable = ['tipo', 'forma_pagamento', 'valortotal', 'status', 'pedido_id'];
  protected $table = 'movimentacao';

  public function pedido(){
    return $this->belongsTo('App\Models\Pedidos');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
  protected $fillable = ['observacao', 'desconto', 'total', 'local_pagamento', 'contato_id', 'entrega_id', 'forma_pagamento', 'entregador_id'];

  public function produtos(){
		return $this->belongsToMany('App\Models\Produto', 'pedido_produto', 'pedido_id', 'produto_id')->withPivot(["qtde", "obsitem", "prvenda"]);
  }

  public function contato(){
    return $this->belongsTo('App\Models\Contato');
  }

  public function entregador(){
    return $this->belongsTo('App\Models\Entregador');
  }

  public function movimentacao(){
    return $this->belongsTo('App\Models\Movimentacao');
  }

  public function endereco(){
    return $this->belongsTo('App\Models\Endereco');
  }
}

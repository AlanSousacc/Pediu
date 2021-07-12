<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
  protected $fillable = ['observacao', 'desconto', 'total', 'local_pagamento', 'contato_id', 'entrega_id', 'forma_pagamento', 'entregador_id', 'empresa_id', 'devolvertroco', 'taxaentrega', 'subtotalpedido', 'statuspedido'];

  public function produtos(){
		return $this->belongsToMany('App\Models\Produto', 'pedido_produto', 'pedido_id', 'produto_id')->withPivot(["qtde", "obsitem", "prvenda"]);
  }

  public function contato(){
    return $this->belongsTo('App\Models\Contato');
  }

  public function entregador(){
    return $this->belongsTo('App\Models\Entregador');
  }

  public function endereco(){
    return $this->belongsTo('App\Models\Endereco');
  }

  public function itenspedidos()
  {
    return $this->hasMany(PedidoProduto::class, 'pedido_id', 'id');
  }

  public function complementositenspedido()
  {
    return $this->hasMany(ComplementoItemPedido::class, 'pedido_id', 'id');
  }

  public function meioameioitempedido()
  {
    return $this->hasMany(MeioameioItemPedido::class, 'pedido_id', 'id');
  }
}

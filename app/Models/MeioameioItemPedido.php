<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeioameioItemPedido extends Model
{
  protected $table    = 'meioameio_item_pedido';
  protected $fillable = ['pedido_id', 'produto_id', 'empresa_id', 'pedidoproduto_id'];
  public $timestamps  = false;

  public function produto()
  {
    return $this->belongsTo(Produto::class, 'produto_id', 'id');
  }

  public function pedido()
  {
    return $this->belongsTo(Pedidos::class, 'produto_id', 'id');
  }

  public function pedidoproduto()
  {
    return $this->belongsTo(PedidoProduto::class, 'pedidoproduto_id', 'id');
  }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplementoItemPedido extends Model
{
  protected $table    = 'complemento_item_pedido';
  protected $fillable = ['pedido_id', 'produto_id', 'complemento_id', 'empresa_id', 'pedidoproduto_id'];
  public $timestamps  = false;

  public function produtos()
  {
    return $this->belongsTo(Produto::class, 'produto_id', 'id');
  }

  public function complemento()
  {
    return $this->belongsTo(Complemento::class, 'complemento_id', 'id');
  }

  public function pedidoproduto()
  {
    return $this->belongsTo(PedidoProduto::class, 'pedidoproduto_id', 'id');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
  protected $table = 'pedido_produto';
  protected $fillable = ['qtde', 'obsitem', 'prvenda', 'produto_id', 'pedido_id'];
  public $timestamps = false;

  public function produtos()
  {
    return $this->belongsTo(Produto::class, 'produto_id', 'id');
  }

  public function pedidos()
  {
    return $this->belongsTo(Pedidos::class, 'pedido_id', 'id');
  }
}

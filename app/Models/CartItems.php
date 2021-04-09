<?php

namespace App\models;

use App\Models\ComplementoItemCart;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
  protected $table = 'cart_items';
  protected $fillable = ['cart_id', 'produto_id', 'preco', 'qtde', 'observacaoitem', 'user_id', 'empresa_id'];

  public function produtos()
  {
    return $this->belongsTo(Produto::class, 'produto_id', 'id');
  }

}

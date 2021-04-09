<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeioameioItemCart extends Model
{
  protected $table    = 'meioameio_item_cart';
  protected $fillable = ['cart_id', 'produto_id', 'empresa_id', 'cartitems_id'];
  public $timestamps  = false;

  public function produtos()
  {
    return $this->belongsTo(Produto::class, 'produto_id', 'id');
  }

  public function cartitem()
  {
    return $this->belongsTo(CartItems::class, 'cartitems_id', 'id');
  }
}

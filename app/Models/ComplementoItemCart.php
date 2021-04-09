<?php

namespace App\Models;

use App\models\CartItems;
use Illuminate\Database\Eloquent\Model;

class ComplementoItemCart extends Model
{
  protected $table    = 'complemento_item_cart';
  protected $fillable = ['cart_id', 'produto_id', 'complemento_id', 'empresa_id', 'cartitems_id'];
  public $timestamps  = false;

  public function produtos()
  {
    return $this->belongsTo(Produto::class, 'produto_id', 'id');
  }

  public function complemento()
  {
    return $this->belongsTo(Complemento::class, 'complemento_id', 'id');
  }

  public function cartitem()
  {
    return $this->belongsTo(CartItems::class, 'cartitems_id', 'id');
  }

}

<?php

namespace App\Models;

use App\models\CartItems;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $table = 'cart';
  protected $fillable = ['user_id', 'empresa_id', 'formapagamento', 'statuspedido', 'observacaopagamento', 'observacaopedido', 'valortroco', 'valorentrega', 'endereco_users_id', 'numberorder', 'totalpedido'];

  public function user(){
    return $this->belongsTo('App\User');
  }

  public function endereco(){
    return $this->belongsTo(EnderecoUsers::class, 'endereco_users_id', 'id');
  }

  public function orderitems()
  {
    return $this->hasMany(CartItems::class, 'cart_id', 'id');
  }

  public function complementositemcart()
  {
    return $this->hasMany(ComplementoItemCart::class);
  }

  public function meioameioitemcart()
  {
    return $this->hasMany(MeioameioItemCart::class);
  }

}

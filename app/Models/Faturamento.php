<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faturamento extends Model
{
  protected $table      = 'faturamento';
	protected $primaryKey = 'id';
  public $timestamps = true;
	protected $guarded 		= ['id', 'empresa_id', 'user_id', 'contato_id', 'pedido_id', 'cart_id', 'tipo_movimento_id', 'created_at', 'update_at'];
	protected $filable 		= [
		'dtmovimento',
		'valor',
  ];

  public function auxfaturamento(){
		return $this->hasMany(AuxFaturamento::class);
	}

  public function tipomovimento(){
    return $this->hasOne(TipoMovimento::class, 'tipo_movimento_id','id');
  }

  public function empresa(){
    return $this->belongsTo(Empresa::class, 'empresa_id','id');
  }

  public function user(){
    return $this->belongsTo(User::class, 'user_id','id');
  }

  public function contato(){
    return $this->belongsTo(Contato::class, 'contato_id','id');
  }

  public function pedido(){
    return $this->belongsTo(Pedidos::class, 'pedido_id','id');
  }

  public function cart(){
    return $this->belongsTo(Cart::class, 'cart_id','id');
  }
}

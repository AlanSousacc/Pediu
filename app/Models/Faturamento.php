<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faturamento extends Model
{
  protected $table      = 'faturamento';
	protected $primaryKey = 'id';
  public $timestamps = true;
	protected $guarded 		= ['id', 'empresa_id', 'user_id', 'tipo_movimento_id', 'created_at', 'update_at'];
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
}

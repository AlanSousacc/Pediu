<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigPagamento extends Model
{
  protected $table      = 'config_pagamento';
	protected $primaryKey = 'id';
  public $timestamps = true;
	protected $guarded 		= ['id', 'empresa_id', 'forma_pagamento_id', 'tipo_movimento_id'];
	protected $filable 		= [
		'status',
  ];

  public function empresa(){
    return $this->belongsTo(Empresa::class, 'empresa_id','id');
  }

  public function formapagamento(){
    return $this->belongsTo(FormaPagamento::class, 'forma_pagamento_id','id');
  }

  public function tipomovimento(){
    return $this->belongsTo(TipoMovimento::class, 'tipo_movimento_id','id');
  }
}

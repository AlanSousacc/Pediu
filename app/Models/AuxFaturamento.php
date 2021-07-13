<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuxFaturamento extends Model
{
  protected $table      = 'aux_faturamento';
	protected $primaryKey = 'id';
  public $timestamps = true;
	protected $guarded 		= ['id', 'faturamento_id', 'forma_pagamento_id', 'created_at', 'update_at'];
	protected $filable 		= [
    'datapagamento',
    'datavencimento',
		'valorfatura',
		'valorpago',
		'valorrestante',
  ];

  public function faturamento(){
		return $this->belongsTo(Faturamento::class, 'faturamento_id', 'id');
	}

  public function formapagamento(){
    return $this->hasOne(FormaPagamento::class, 'forma_pagamento_id','id');
  }

  public function auxfaturamentolog(){
    return $this->hasMany(AuxFaturamentoLog::class);
  }
}

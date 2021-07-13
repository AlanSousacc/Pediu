<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuxFaturamentoLog extends Model
{
  protected $table      = 'aux_faturamento_log';
	protected $primaryKey = 'id';
  public $timestamps = true;
	protected $guarded 		= ['id', 'aux_faturamento_id', 'data_pagamento', 'valorfatura', 'valorpago', 'valorrestante', 'created_at', 'update_at'];
	protected $filable 		= [];

  public function auxfaturamento(){
		return $this->belongsTo(AuxFaturamento::class, 'aux_faturamento_id', 'id');
	}

}

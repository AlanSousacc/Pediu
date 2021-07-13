<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
	protected $table      = 'forma_pagamento';
	protected $primaryKey = 'id';
  public $timestamps = true;
	protected $guarded 		= ['id', 'created_at', 'update_at'];
	protected $filable 		= [
		'descricao',
		'empresa_id',
		'parcelas',
		'status',
  ];

  public function empresa(){
    return $this->belongsTo(Empresa::class, 'empresa_id','id');
  }

  public function configpagamento(){
		return $this->hasMany(ConfigPagamento::class);
	}

  public function auxfaturamento(){
		return $this->hasMany(AuxFaturamento::class);
	}
}

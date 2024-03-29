<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
  protected $fillable = ['descricao', 'empresa_id', 'image'];

  public function produtos(){
		return $this->hasMany('App\Models\Produto');
	}

  public function empresa(){
		return $this->belongsTo('App\Models\Empresa');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
  protected $fillable = ['descricao', 'empresa_id'];

  public function produtos(){
		return $this->hasMany('App\Models\Produto');
	}
}

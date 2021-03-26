<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complemento extends Model
{
  protected $fillable = ['descricao', 'preco', 'empresa_id'];

  public function produtos(){
		return $this->hasMany('App\Models\Produto');
	}
}

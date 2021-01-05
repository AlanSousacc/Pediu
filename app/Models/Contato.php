<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
  protected $fillable = ['nome', 'documento', 'telefone', 'tipo', 'ativo'];

  public function entregas(){
    return $this->hasMany('App\Models\Endereco');
  }
}

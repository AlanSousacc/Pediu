<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $table = "cliente";
  protected $fillable = ['nome', 'cidade', 'endereco', 'numero', 'bairro', 'celular', 'razao', 'fantasia', 'cnpj', 'telefone','email', 'logo'];

  public function empresa(){
    return $this->belongsTo('App\Models\Empresa');
  }

}
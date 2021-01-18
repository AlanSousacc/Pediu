<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
  protected $fillable = ['uuid', 'razao', 'fantasia', 'celular', 'nome', 'cidade', 'endereco', 'numero', 'bairro', 'cnpj','email', 'logo', 'active', 'cliente_id'];

  public function cliente(){
    return $this->belongsTo('App\Models\Cliente');
  }

  public function licenca(){
		return $this->hasOne('App\Models\Licenca');
  }

  public function users(){
    return $this->hasMany('App\User');
	}
}

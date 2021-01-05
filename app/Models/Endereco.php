<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
  protected $fillable = ['endereco', 'numero', 'bairro', 'cidade', 'cep', 'telefone_entrega', 'status', 'principal', 'contato_id', 'observacao'];

  public function contato(){
		return $this->belongsTo('App\Models\Contato');
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnderecoUsers extends Model
{
  protected $table = 'endereco_users';
  protected $fillable = ['endereco', 'numero', 'bairro', 'cidade', 'telefone', 'principal', 'user_id', 'empresa_id'];

	public function user(){
    return $this->belongsTo('App\User');
  }
}

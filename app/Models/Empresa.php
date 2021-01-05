<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
  protected $fillable = ['uuid', 'razao', 'fantasia', 'celular', 'nome', 'cidade', 'endereco', 'numero', 'bairro', 'cnpj','email', 'logo', 'active', 'expires_at'];
}

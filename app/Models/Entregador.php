<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entregador extends Model
{
  protected $table = 'entregadores';
  protected $fillable = ['nome', 'endereco', 'numero', 'telefone', 'cidade', 'cep', 'veiculo', 'placa', 'status'];
}

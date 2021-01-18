<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
  protected $fillable = ['descricao', 'tipo', 'precocusto', 'precovenda', 'status', 'composicao', 'grupo_id', 'empresa_id'];

  public function Temp_prod_pedido(){
		return $this->belongsTo('App\Models\Temp_prod_pedido');
  }

  public function grupo(){
		return $this->belongsTo('App\Models\Grupo');
  }
}

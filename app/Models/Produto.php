<?php

namespace App\Models;

use App\models\CartItems;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
  protected $fillable = ['descricao', 'tipo', 'precocusto', 'precovenda', 'status', 'composicao', 'grupo_id', 'empresa_id', 'foto'];

  public function Temp_prod_pedido(){
		return $this->belongsTo('App\Models\Temp_prod_pedido');
  }

  public function grupo(){
		return $this->belongsTo('App\Models\Grupo');
  }

  public function empresa(){
		return $this->belongsTo('App\Models\Empresas');
  }

  public function complementos(){
		return $this->belongsToMany('App\Models\Complemento', 'complemento_produto', 'produto_id', 'complemento_id')->withPivot(["preco"]);
  }
}

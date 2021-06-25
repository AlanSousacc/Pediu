<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FluxoMovimentacao extends Model
{
  protected $table = 'fluxo_movimentacao';
  protected $fillable = ['tipo', 'forma_movimentacao', 'valortotal', 'valor', 'empresa_id', 'movimentacao_id'];

  public function movimentacao()
  {
    return $this->belongsTo(Movimentacao::class, 'movimentacao_id', 'id');
  }
}

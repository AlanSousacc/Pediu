<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMovimento extends Model
{
  protected $table = 'tipo_movimento';
  protected $primaryKey = 'id';
  protected $fillable = ['descricao'];
  protected $guarded 		= ['id', 'created_at', 'update_at'];
  public $timestamps = true;

  public function faturamentos()
  {
    return $this->belongsTo(Faturamento::class, 'tipo_movimento_id', 'id');
  }

  public function configpagamentos()
  {
    return $this->belongsTo(ConfigPagamento::class, 'tipo_movimento_id', 'id');
  }
}

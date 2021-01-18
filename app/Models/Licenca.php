<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licenca extends Model
{
  protected $table = 'licenca';
  protected $filable = ['dtvalidade', 'dtinicio', 'status', 'empresa_id'];

	public function empresa(){
    return $this->hasOne('App\Models\Empresa');
  }
}

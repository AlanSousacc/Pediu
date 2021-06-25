<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
  protected $table = "configuracaoes";
  protected $fillable = ['controlaentrega', 'empresa_id', 'valorentrega', 'statuscancelado', 'statusentregue', 'statusentregando', 'statuspreparando',
   'statusrecebido', 'tempominimoentrega', 'controlepedidosbalcao', 'colorsidebar', 'maiorprecomeioameio'
  ];

}

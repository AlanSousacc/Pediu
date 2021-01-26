<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Licenca;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;

class LicencaController extends Controller
{
  public function store(Request $request)
  {
    $data 		= $request->except('_token');
    $dt			  = Carbon::now();
    $licencas = Licenca::where('empresa_id', $data['empresa_id'])->first();

    /**
    * verifica se existe licença para a empresa.
    * se não existir ele cria uma licença.
    * se existir ele faz o update
    */
    if ($licencas == null) {
      if($data['valstart'] > $dt->toDateString())
      throw new Exception('A data inicial da licença deve ser maior ou igual a data de hoje');

      /**
      * se o status for == 0(inativo) ele define as propriedades da licença existente como vazias
      * se o status for == 1(ativo) ele aplica as propriedades vindas do formulario
      */

      $licenca = new Licenca;
      $empresa = Empresa::where('id', $data['empresa_id'])->first();
      $empresa->active      = $data['status'] == 0 ? 'N' : 'S';
      $licenca->dtvalidade  = $data['status'] == 0 ? null : $data['valend'];
      $licenca->dtinicio 	  = $data['status'] == 0 ? null : $data['valstart'];
      $licenca->status      = $data['status'] == 0 ? 0 : $data['status'];
      $licenca->empresa_id  = $data['empresa_id'];

    } else {
      // faz o update caso ja exista licença
      $licenca = Licenca::where('empresa_id', $data['empresa_id'])->firstOrFail();
      if ($data['valstart'] < $dt->toDateString())
        return redirect()->route('empresa.index')->with('error', 'A data inicial da licença deve ser maior ou igual a data de hoje');

      $empresa = Empresa::where('id', $data['empresa_id'])->first();
      $empresa->active      = $data['status'] == 0 ? 'N' : 'S';
      $licenca->dtvalidade  = $data['status'] == 0 ? null : $data['valend'];
      $licenca->dtinicio 	  = $data['status'] == 0 ? null : $data['valstart'];
      $licenca->status      = $data['status'] == 0 ? 0 : $data['status'];
      $licenca->empresa_id  = $data['empresa_id'];

    }

    $saved = $licenca->save();
    $savedemp = $empresa->update();
    if (!$saved && !$savedemp){
      return redirect()->route('empresa.index')->with('error', 'Falha ao salvar esta licença com esta empresa');
    }
    return redirect()->route('empresa.index')->with('success', 'Licença salva com sucesso!');
  }
}

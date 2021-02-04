<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracaoController extends Controller
{
  private $repository;
  public function __construct(Configuracao $config)
  {
    $this->repository = $config;
  }

  public function create(){
    $config = $this->repository::where('empresa_id', Auth::user()->empresa_id)->first();
    return view('pages.configuracoes.configuracao', compact('config'));
  }

  public function update(Request $request, $id)
  {
    $data = $request->except('_token');
    $user = Auth::user()->empresa_id;
    $config = $this->repository::where('empresa_id', $user)->first();

    if(!$config){
      isset($data['controlaentrega']) && $data['controlaentrega'] == 'on' ? 1 : 0;
      $data['empresa_id'] = $user;
      $data['valorentrega'] = str_replace (',', '.', str_replace ('.', '', $data['valorentrega']));
    } else {
      $config->controlaentrega = isset($data['controlaentrega']) && $data['controlaentrega'] == 'on' ? 1 : 0;
      $config->valorentrega = str_replace (',', '.', str_replace ('.', '', $data['valorentrega']));
      $config->empresa_id = $user;
    }

    $save = $config != null ? $config->save() : $save = $this->repository->create($data);

    if (!$save)
      return redirect()->back()->with('error', 'Falha ao salvar Configurações!');

    return redirect()->back()->with('success', 'Configurações salvas com sucesso!');
  }
}

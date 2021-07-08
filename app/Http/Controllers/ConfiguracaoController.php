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

  public function getConfigEmpresa()
  {
    $config = $this->repository::where('empresa_id', Auth::user()->empresa_id)->first();

    return response()->json([
      'config' => $config
    ]);
  }

  public function update(Request $request, $id)
  {
    $data = $request->except('_token');
    $user = Auth::user()->empresa_id;
    $config = $this->repository::where('empresa_id', $user)->first();

    if(!$config){
      isset($data['controlaentrega']) && $data['controlaentrega'] == 'on' ? 1 : 0;
      isset($data['controlepedidosbalcao']) && $data['controlepedidosbalcao'] == 'on' ? 1 : 0;
      isset($data['controlecozinha']) && $data['controlecozinha'] == 'on' ? 1 : 0;
      $data['empresa_id']        = $user;
      $data['valorentrega']      = str_replace (',', '.', str_replace ('.', '', $data['valorentrega']));
      $data['tempomediopreparo'] = $data['tempomediopreparo'];
    } else {
      $config->controlaentrega     = isset($data['controlaentrega']) && $data['controlaentrega'] == 'on' ? 1 : 0;
      $config->maiorprecomeioameio = isset($data['maiorprecomeioameio']) && $data['maiorprecomeioameio'] == 'on' ? 1 : 0;
      $config->controlecozinha     = isset($data['controlecozinha']) && $data['controlecozinha'] == 'on' ? 1 : 0;

      $config->controlepedidosbalcao = isset($data['controlepedidosbalcao']) && $data['controlepedidosbalcao'] == 'on' ? 1 : 0;
      $config->valorentrega          = str_replace (',', '.', str_replace ('.', '', $data['valorentrega']));
      $config->tempomediopreparo     = $data['tempomediopreparo'];
      $config->empresa_id            = $user;
    }

    $config->tempominimoentrega = $data['tempominimoentrega'];
    $config->statusrecebido     = $data['statusrecebido'];
    $config->statuspreparando   = $data['statuspreparando'];
    $config->statusentregando   = $data['statusentregando'];
    $config->statusentregue     = $data['statusentregue'];
    $config->statuscancelado    = $data['statuscancelado'];
    $config->colorsidebar       = $data['colorsidebar'];

    $save = $config != null ? $config->save() : $save = $this->repository->create($data);

    if (!$save)
      return redirect()->back()->with('error', 'Falha ao salvar Configurações!');

    return redirect()->back()->with('success', 'Configurações salvas com sucesso!');
  }
}

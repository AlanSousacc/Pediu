<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntregadorRequest;
use Illuminate\Http\Request;

use App\Models\Entregador;
use Exception;
use Auth;

class EntregadorController extends Controller
{
  protected $entregador;

  public function __construct(Entregador $entregador)
  {
    $this->entregador = $entregador;
  }

  public function index()
  {
    $consulta = $this->entregador->where('empresa_id', Auth::user()->empresa_id)->paginate();

    return view('pages.entregadores.listagemEntregador', compact('consulta'));
  }

  public function create(){
    return view('pages.entregadores.novoEntregador');
  }

  public function store(EntregadorRequest $request)
  {
    $data = $request->except('_token');
    $data['empresa_id'] = Auth::user()->empresa_id;

    $entregador = $this->entregador->create($data);

    if (!$entregador)
      throw new Exception('Falha ao salvar este Entregador!');

    return redirect()->back()->with('success', 'Entregador criado com sucesso!');
  }

  public function edit($id)
  {
    $entregador = $this->entregador->find($id);

    return view('pages.entregadores.editar', compact('entregador'));
  }

  public function update(EntregadorRequest $request, $id)
  {
    if (!$entregador = $this->entregador->find($id))
    throw new Exception("Nenhum Entregador encontrado");

    $saved = $entregador->update($request->all());

    if (!$saved){
      throw new Exception('Falha ao alterar Entregador!');
    }

    return redirect()->back()->with('success', 'Entregador alterado com sucesso!');
  }

  public function destroy(Request $request)
  {
    $entregador = $this->entregador->find($request->entregador_id);

    if (!$entregador)
    throw new Exception("Nenhum Entregador encontrado!");

    $saved = $entregador->delete();

    if (!$saved)
    throw new Exception('Falha ao remover este Entregador!');

    return redirect()->back()->with('success', 'Entregador #' . $entregador->id . ' removido com sucesso!');

  }
}

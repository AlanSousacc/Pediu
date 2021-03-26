<?php

namespace App\Http\Controllers;

use App\Models\Complemento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplementoController extends Controller
{
  protected $complemento;

  public function __construct(Complemento $complemento)
  {
    $this->complemento = $complemento;
  }

  public function index()
  {
    $consulta = $this->complemento->where('empresa_id', Auth::user()->empresa_id)->paginate();

    return view('pages.complementos.listagemComplemento', compact('consulta'));
  }

  public function create(){
    return view('pages.complementos.novoComplemento');
  }

  public function store(Request $request)
  {
    $data = $request->except('_token');

    $data['empresa_id'] = Auth::user()->empresa_id;

    $data['preco'] = str_replace (',', '.', str_replace ('.', '', $data['preco']));

    $complemento = $this->complemento->create($data);

    if (!$complemento)
      return redirect()->back()->with('error', 'Falha ao salvar este Complemento!');

    return redirect()->back()->with('success', 'Complemento criado com sucesso!');
  }

  public function edit($id)
  {
    $complemento = $this->complemento->find($id);

    return view('pages.complementos.editar', compact('complemento'));
  }

  public function update(Request $request, $id)
  {
    if (!$complemento = $this->complemento->find($id))
    throw new Exception("Nenhum Complemento encontrado");

    $data = $request->except('_token');

    $data['preco'] = str_replace (',', '.', str_replace ('.', '', $data['preco']));

    $saved = $complemento->update($data);

    if (!$saved)
      return redirect()->back()->with('error', 'Falha ao alterar Complemento!');

    return redirect()->route('complemento.index')->with('success', 'Complemento alterado com sucesso!');
  }

  public function destroy(Request $request)
  {
    $complemento = $this->complemento->find($request->complemento_id);

    if (!$complemento)
      return redirect()->back()->with('error', "Nenhum complemento encontrado!");

    $saved = $complemento->delete();

    if (!$saved)
      return redirect()->back()->with('error', 'Falha ao remover este complemento!');

    return redirect()->back()->with('success', 'complemento #' . $complemento->id . ' removido com sucesso!');

  }

  public function returnPreco($id)
  {
    $complemento = $this->complemento->where('empresa_id', Auth::user()->empresa_id)->where('id', $id)->get();

    return response()->json([
      "data" => $complemento
    ]);
  }

  public function buscaComplementoProduto($id){
    $complemento = $this->complemento->where('empresa_id', Auth::user()->empresa_id)->findOrFail($id);

    return response()->json([
      'data' => $complemento
    ]);
  }
}

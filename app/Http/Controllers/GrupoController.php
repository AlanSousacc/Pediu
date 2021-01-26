<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GrupoController extends Controller
{
  protected $grupo;

  public function __construct(Grupo $grupo)
  {
    $this->grupo = $grupo;
  }

  public function index()
  {
    $consulta = $this->grupo->where('empresa_id', Auth::user()->empresa_id)->paginate();

    return view('pages.grupos.listagemGrupo', compact('consulta'));
  }

  public function create(){
    return view('pages.grupos.novoGrupo');
  }

  public function store(Request $request)
  {
    $data = $request->except('_token');
    $data['empresa_id'] = Auth::user()->empresa_id;

    if(isset($request->image)){
      $data['image'] = $request->image->store("img/".Auth::user()->empresa->uuid. "/imagesGrupos");
    } else  {
      $data['image'] = 'img/logos/default.png';
    }

    $grupo = $this->grupo->create($data);

    if (!$grupo)
      return redirect()->back()->with('error', 'Falha ao salvar este Grupo!');

    return redirect()->route('grupo.index')->with('success', 'Grupo criado com sucesso!');
  }

  public function edit($id)
  {
    $grupo = $this->grupo->find($id);

    return view('pages.grupos.editar', compact('grupo'));
  }

  public function update(Request $request, $id)
  {
    if (!$grupo = $this->grupo->find($id))
    throw new Exception("Nenhum Grupo encontrado");

    $data = $request->except('_token');

    if(isset($request->image)){
      $data['image'] = $request->image->store("img/".Auth::user()->empresa->uuid. "/imagesGrupos");
    } else if($data['carregaimage'] != null){
      $data['image'] = $data['carregaimage'];
    } else {
      $data['image'] = 'img/logos/default.png';
    }

    $saved = $grupo->update($data);

    if (!$saved)
      return redirect()->back()->with('error', 'Falha ao alterar Grupo!');

    return redirect()->route('grupo.index')->with('success', 'Grupo alterado com sucesso!');
  }

  public function destroy(Request $request)
  {
    $grupo = $this->grupo->find($request->grupo_id);

    $produtos = Produto::where('grupo_id', $request->grupo_id)->get();

    Storage::delete($grupo->image);

    if (count($produtos) >= 1)
      return redirect()->back()->with('error', "Este grupo não pode ser removido, existem produtos relacionados a ele!");

    if (!$grupo)
      return redirect()->back()->with('error', "Nenhum grupo encontrado!");

    $saved = $grupo->delete();

    if (!$saved)
      return redirect()->back()->with('error', 'Falha ao remover este grupo!');

    return redirect()->back()->with('success', 'grupo #' . $grupo->id . ' removido com sucesso!');

  }
}

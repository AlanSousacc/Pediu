<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EnderecoRequest;

use App\Models\Endereco;
use Exception;
use Illuminate\Support\Facades\Auth;

class EnderecoController extends Controller
{
  protected $endereco;
  public function __construct(Endereco $endereco)
  {
    $this->endereco = $endereco;
  }

  public function index()
  {
    $consulta = $this->endereco->where('empresa_id', Auth::user()->empresa_id)->paginate();
    return view('pages.enderecos.listagemEndereco', compact('consulta'));
  }

  public function listaEnderecoContato($id)
  {
    $consulta = $this->endereco->Where('contato_id', $id)->paginate();
    return view('pages.enderecos.listagemEndereco', compact('consulta', 'id'));
  }

  public function createEndereco($id){
    return view('pages.enderecos.novoEndereco', compact('id'));
  }

  public function returnEndereco($id)
  {
    $entrega = $this->endereco->where('contato_id', $id)->where('status', 1)->orderby('principal', 'DESC')->get();

    return response()->json(["data" => $entrega]);
  }

  public function store(EnderecoRequest $request)
  {
    $data = $request->except('_token');
    $data['empresa_id'] = Auth::user()->empresa_id;

    $endereco = $this->endereco->create($data);

    $saved = $endereco->save();

    if (!$saved)
    throw new Exception('Falha ao salvar este Local de Entrega!');

    return redirect()->back()->with('success', 'Local de Entrega criado com sucesso!');
  }

  public function edit($id)
  {
    $entrega = $this->endereco->find($id);

    return view('pages.enderecos.editar', compact('entrega'));
  }

  public function update(EnderecoRequest $request, $id)
  {
    $endereco = $this->endereco->find($id);

    if (!$endereco)
      throw new Exception("Nenhum endereço de entrega encontrado");

    $saved = $endereco->update($request->all());

    if (!$saved)
      throw new Exception('Falha ao alterar Endereço!');

    return redirect()->back()->with('success', 'Contato alterado com sucesso!');
  }

  public function destroy(Request $request)
  {
    $entrega = $this->endereco->find($request->contato_id);

    if (!$entrega)
    throw new Exception("Nenhum Endereço de entrega encontrado!");

    $saved = $entrega->delete();

    if (!$saved)
      throw new Exception('Falha ao remover este Endereço de entrega!');

    return redirect()->back()->with('success', 'Endereço de entrega #' . $entrega->id . ' removido com sucesso!');
  }
}

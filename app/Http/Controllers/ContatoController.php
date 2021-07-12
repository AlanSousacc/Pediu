<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContatoRequest;
use Illuminate\Support\Facades\DB;

use App\Models\Contato;
use App\Models\Endereco;
use Exception;
use Auth;

class ContatoController extends Controller
{
  private $contato, $endereco;
  public function __construct(Contato $contato, Endereco $endereco)
  {
    $this->contato = $contato;
    $this->endereco = $endereco;
  }

  public function index()
  {
    $consulta = $this->contato->where('empresa_id', Auth::user()->empresa_id)->with('entregas')->paginate();

    return view('pages.contatos.listagemContato', compact('consulta'));
  }

  public function getContato()
	{
    $contatos = $this->contato->where('empresa_id', Auth::user()->empresa_id)->where('ativo', 1)->get();

		return response()->json([
      'data' => [
        'contatos' => $contatos
      ]
    ]);
	}

  public function getEnderecoCliente($id)
	{
    $enderecos = $this->endereco->where('empresa_id', Auth::user()->empresa_id)->where('contato_id', $id)->get();

		return response()->json([
      'data' => [
        'enderecos' => $enderecos
      ]
    ]);
	}

  public function create()
  {
    return view('pages.contatos.novoContato');
  }

  public function store(ContatoRequest $request)
  {
    $data = $request->except('_token');

    $data['empresa_id'] = Auth::user()->empresa_id;
    $contato = $this->contato->create($data);
    $saveContato = $contato->save();

    if (!$saveContato)
    throw new Exception('Falha ao salvar este contato!');

    $data['contato_id'] = $contato->id;
    $endereco = $this->endereco->create($data);
    $saveEndereco = $endereco->save();

    if (!$saveEndereco)
    throw new Exception('Falha ao salvar Endereço!');

    return redirect()->back()->with('success', 'Contato criado com sucesso!');
  }

  public function edit($id)
  {
    $contato = $this->contato->find($id);
    $entrega = $this->endereco->where('contato_id', $id)->first();

    return view('pages.contatos.editar', compact('contato', 'entrega'));
  }

  public function update(ContatoRequest $request, $id)
  {
    $data = $request->except('_token');

    if (!$contato = $this->contato->find($id))
    throw new Exception("Nenhum contato encontrado");

    $saveContato = $contato->update($data);

    if (!$saveContato)
    throw new Exception('Falha ao alterar este contato!');

    $endereco = $this->endereco->where('contato_id', $id)->first();
    $data['contato_id'] = $contato->id;
    $saveEndereco = $endereco->update($data);

    if (!$saveEndereco)
    throw new Exception('Falha ao alterar Endereço!');

    return redirect()->back()->with('success', 'Contato alterado com sucesso!');
  }

  public function destroy(Request $request)
  {
    $contato = $this->contato->find($request->contato_id);
    $entrega = $this->endereco->where('contato_id', $request->contato_id)->get();

    if (!$contato)
    throw new Exception("Nenhum contato encontrado!");

    if (count($entrega) > 0)
      return redirect()->back()->with('error', "Existem endereços relacionados a este contato, exclua-os primeiro ou inative este contato!");

    $saved = $contato->delete();
    if (!$saved)
    throw new Exception('Falha ao remover este contato!');

    return redirect()->back()->with('success', 'Contato #' . $contato->id . ' removido com sucesso!');
  }
}

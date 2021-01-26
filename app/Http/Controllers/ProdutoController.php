<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Produto;
use App\Models\Pedidos;
use App\Models\Grupo;
use Exception;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
  protected $produto;

  public function __construct(Produto $produto)
  {
    $this->produto = $produto;
  }

  public function index()
  {
    $consulta = $this->produto->where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->paginate();
    return view('pages.produtos.listagemProduto', compact('consulta'));
  }

  public function buscaProdutoPedido($id){
    $produto = $this->produto->findOrFail($id);

    return response()->json([
      'data' => $produto
    ]);
  }

  public function create(){
    $grupos = Grupo::all();
    return view('pages.produtos.novoProduto', compact('grupos'));
  }

  public function returnPreco($id)
  {
    $produto = $this->produto->where('id', $id)->get();

    return response()->json([
      "data" => $produto
    ]);
  }

  public function store(ProdutoRequest $request) {
    $data = $request->except('_token');

    $produto             = new Produto;
    $produto->descricao  = $data['descricao'];
    $produto->empresa_id = Auth::user()->empresa_id;
    $produto->composicao = $data['composicao'];
    $produto->tipo       = $data['tipo'];
    $produto->precocusto = str_replace (',', '.', str_replace ('.', '', $data['precocusto']));
    $produto->precovenda = str_replace (',', '.', str_replace ('.', '', $data['precovenda']));
    $produto->status     = $data['status'];
    if($data['grupo_id'] != 0)
      $produto->grupo_id   = $data['grupo_id'];

    if(isset($request->foto)){
      $produto->foto = $request->foto->store("img/".Auth::user()->empresa->uuid. "/fotosProdutos");
    } else  {
      $produto->foto = 'img/logos/default.png';
    }

    $saved = $produto->save();

    if (!$saved)
      return redirect()->back()->with('error', 'Falha ao salvar Produto!');

    return redirect()->back()->with('success', 'Produto criado com sucesso!');
  }

  public function edit($id)
	{
    $produto = $this->produto->find($id);
    $grupos  = Grupo::all();
		return view('pages.produtos.editar', compact('produto', 'grupos'));
  }

  public function returnProdutoPedido($id)
	{
    $pedido = Pedidos::findOrFail($id);

		return response()->json([
      'data' => [
        'pedido' => $pedido,
        'produtos' => $pedido->produtos,
      ]
    ]);
	}

  public function update(ProdutoRequest $request, $id)
  {
    $data = $request->except('_token');

    $produto = $this->produto->find($id);

    if (!$produto)
      throw new Exception("Nenhum Produto encontrado");

    $produto->descricao  = $data['descricao'];
    $produto->composicao = $data['composicao'];
    $produto->tipo       = $data['tipo'];
    $produto->precocusto = str_replace (',', '.', str_replace ('.', '', $data['precocusto']));
    $produto->precovenda = str_replace (',', '.', str_replace ('.', '', $data['precovenda']));
    $produto->status     = $data['status'];

    if(isset($request->foto)){
      $produto->foto = $request->foto->store("img/".Auth::user()->empresa->uuid. "/fotosProdutos");
    } else if($data['carregafoto'] != null){
      $produto->foto = $data['carregafoto'];
    } else {
      $produto->foto = 'img/logos/default.png';
    }

    // dd($data);
    $saved = $produto->save();
    if (!$saved)
      return redirect()->back()->with('error', 'Falha ao Alterar Produto!');

    return redirect()->route('produto.index')->with('success', 'Produto alterado com sucesso!');
  }

  public function destroy(Request $request)
  {
    $produto = $this->produto->find($request->produto_id);

    $pedidos = DB::table('pedido_produto')
              ->where('pedido_produto.produto_id', $produto->id)
              ->get();

    if (count($pedidos) >= 1)
      return redirect()->back()->with('error', 'Não é possível remover este produto, ele já foi vendido, você pode inativa-lo!');

    if (!$produto)
      return redirect()->back()->with('error', 'Nenhum Produto encontrado!');

    Storage::delete($produto->foto);

    $saved = $produto->delete();

    if (!$saved)
      return redirect()->back()->with('error', 'Falha ao remover este Produto!');

    // se chegou aqui é pq deu tudo certo
    return redirect()->back()->with('success', 'Produto #' . $produto->id . ' removido com sucesso!');

  }
}

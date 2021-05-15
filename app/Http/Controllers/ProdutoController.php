<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Complemento;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Produto;
use App\Models\Pedidos;
use App\Models\Grupo;
use Auth;
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
    $consulta = $this->produto->where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->with('grupo')->paginate(10);
    return view('pages.produtos.listagemProduto', compact('consulta'));
  }

  public function buscaProdutoPedido($id){
    $produto = $this->produto->where('empresa_id', Auth::user()->empresa_id)->findOrFail($id);

    return response()->json([
      'data' => $produto
    ]);
  }

  public function create(){
    $grupos       = Grupo::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
    $complementos = Complemento::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
    return view('pages.produtos.novoProduto', compact('grupos', 'complementos'));
  }

  public function returnPreco($id)
  {
    $produto = $this->produto->where('empresa_id', Auth::user()->empresa_id)->where('id', $id)->get();

    return response()->json([
      "data" => $produto
    ]);
  }

  public function store(ProdutoRequest $request) {
    $data = $request->except('_token');

    $produto                    = new Produto;
    $produto->descricao         = $data['descricao'];
    $produto->empresa_id        = Auth::user()->empresa_id;
    $produto->composicao        = $data['composicao'];
    $produto->saboresdiversos   = $data['saboresdiversos'];
    if($data['controlatamanho'] == 1){
      $produto->precopequeno    = str_replace (',', '.', str_replace ('.', '', $data['precopequeno']));
      $produto->precomedio      = str_replace (',', '.', str_replace ('.', '', $data['precomedio']));
      $produto->precogrande     = str_replace (',', '.', str_replace ('.', '', $data['precogrande']));
      $produto->precovenda      = str_replace (',', '.', str_replace ('.', '', $data['precomedio']));
      $produto->controlatamanho = 1;
    } else {
      $produto->precopequeno    = null;
      $produto->precomedio      = null;
      $produto->precogrande     = null;
      $produto->controlatamanho = 0;
      $produto->precovenda      = str_replace (',', '.', str_replace ('.', '', $data['precovenda']));
    }
    $produto->precocusto        = str_replace (',', '.', str_replace ('.', '', $data['precocusto']));
    $produto->status            = $data['status'];

    if($data['grupo_id'] != 0)
      $produto->grupo_id   = $data['grupo_id'];

    if(isset($request->foto)){
      $produto->foto = $request->foto->store("img/".Auth::user()->empresa->slug. "/fotosProdutos");
    } else  {
      $produto->foto = 'img/logos/default.png';
    }

    $saved = $produto->save();

    if(isset($data['complemento_listagem_id'])){
    foreach($data['complemento_listagem_id'] as $i => $produto_id ){
      $preco = $data['preco'][$i];

      $produto->complementos()->attach([
        $produto_id => ['preco' => $preco]
        ]);
      }
    }
    if (!$saved)
      return redirect()->back()->with('error', 'Falha ao salvar Produto!');

    return redirect()->back()->with('success', 'Produto criado com sucesso!');
  }

  public function edit($id)
	{
    $produto      = $this->produto->where('empresa_id', Auth::user()->empresa_id)->find($id);
    $grupos       = Grupo::where('empresa_id', Auth::user()->empresa_id)->get();
    $complementos = Complemento::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
		return view('pages.produtos.editar', compact('produto', 'grupos', 'complementos'));
  }

  public function returnProdutoPedido($id)
	{
    $pedido = Pedidos::where('empresa_id', Auth::user()->empresa_id)->findOrFail($id);

		return response()->json([
      'data' => [
        'pedido' => $pedido,
        'produtos' => $pedido->produtos,
      ]
    ]);
	}

  public function returnProdutoComplementos($id)
	{
    $produto = Produto::where('empresa_id', Auth::user()->empresa_id)->findOrFail($id);

		return response()->json([
      'data' => [
        'produto' => $produto,
        'produtos'    => $produto->complementos,
      ]
    ]);
	}

  public function update(ProdutoRequest $request, $id)
  {
    $data = $request->except('_token');
    $produto = $this->produto->find($id);

    if (!$produto)
      return redirect()->route('produto.index')->with('error', 'Nenhum Produto encontrado');

    $produto->descricao         = $data['descricao'];
    $produto->composicao        = $data['composicao'];
    $produto->grupo_id          = $data['grupo_id'];
    $produto->saboresdiversos   = $data['saboresdiversos'];
    if($data['controlatamanho'] == 1){
      $produto->precopequeno    = str_replace (',', '.', str_replace ('.', '', $data['precopequeno']));
      $produto->precomedio      = str_replace (',', '.', str_replace ('.', '', $data['precomedio']));
      $produto->precogrande     = str_replace (',', '.', str_replace ('.', '', $data['precogrande']));
      $produto->precovenda      = str_replace (',', '.', str_replace ('.', '', $data['precomedio']));
      $produto->controlatamanho = 1;

    } else {
      $produto->precopequeno    = null;
      $produto->precomedio      = null;
      $produto->precogrande     = null;
      $produto->controlatamanho = 0;
      $produto->precovenda      = str_replace (',', '.', str_replace ('.', '', $data['precovenda']));
    }
    $produto->precocusto = str_replace (',', '.', str_replace ('.', '', $data['precocusto']));
    $produto->status     = $data['status'];

    if(isset($request->foto)){
      $produto->foto = $request->foto->store("img/".Auth::user()->empresa->slug. "/fotosProdutos");
    } else if($data['carregafoto'] != null){
      $produto->foto = $data['carregafoto'];
    } else {
      $produto->foto = 'img/logos/default.png';
    }

    $saved = $produto->save();
    if (!$saved)
      return redirect()->back()->with('error', 'Falha ao Alterar Produto!');

    if(isset($data['complemento_listagem_id'])){
      $produtos = [];
      $produto->complementos()->detach();
      foreach($data['complemento_listagem_id'] as $i => $produto_id ){
        $preco = $data['preco'][$i];

        $produto->complementos()->attach([
          $produto_id => ['preco' => $preco]
        ]);
      }
    }

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

    $produto->complementos()->detach();

    $saved = $produto->delete();

    if (!$saved)
      return redirect()->back()->with('error', 'Falha ao remover este Produto!');

    // se chegou aqui é pq deu tudo certo
    return redirect()->back()->with('success', 'Produto #' . $produto->id . ' removido com sucesso!');

  }
}

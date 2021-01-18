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

class ProdutoController extends Controller
{
  protected $produto;

  public function __construct(Produto $produto)
  {
    $this->produto = $produto;
  }

  public function index()
  {
    $consulta = $this->produto->where('empresa_id', Auth::user()->empresa_id)->paginate();
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

    try{
      $produto             = new Produto;
      $produto->descricao  = $data['descricao'];
      $produto->empresa_id = Auth::user()->empresa_id;
      $produto->composicao = $data['composicao'];
      $produto->tipo       = $data['tipo'];
      $produto->precocusto = str_replace (',', '.', str_replace ('.', '', $data['precocusto']));
      $produto->precovenda = str_replace (',', '.', str_replace ('.', '', $data['precovenda']));
      $produto->status     = $data['status'];
      if($data['grupo_id'] != 0){
        $produto->grupo_id   = $data['grupo_id'];
      }

    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
      exit();
    }

    try{
			DB::beginTransaction();

      $saved = $produto->save();

      if (!$saved)
        throw new Exception('Falha ao salvar Produto!');

			DB::commit();
			return redirect()->back()->with('success', 'Produto criado com sucesso!');

    } catch (Exception $e) {

      DB::rollBack();
      return redirect()->back()->with('error', $e->getMessage());
    }
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

    try{
      $produto = $this->produto->find($id);

      if (!$produto)
        throw new Exception("Nenhum Produto encontrado");

      $produto->descricao  = $data['descricao'];
      $produto->composicao = $data['composicao'];
      $produto->tipo       = $data['tipo'];
      $produto->precocusto = str_replace (',', '.', str_replace ('.', '', $data['precocusto']));
      $produto->precovenda = str_replace (',', '.', str_replace ('.', '', $data['precovenda']));
      $produto->status     = $data['status'];
      $saved = $produto->save();

    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
      exit();
    }

    try{
      DB::beginTransaction();

      if (!$saved){
				throw new Exception('Falha ao Alterar Produto!');
			}

			DB::commit();
			return redirect()->back()->with('success', 'Produto alterado com sucesso!');

    } catch (Exception $e) {

      DB::rollBack();
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function destroy(Request $request)
  {
    try{
			$produto = $this->produto->find($request->produto_id);

      if (!$produto)
        throw new Exception("Nenhum Produto encontrado!");

    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
      exit();
    }

    try{
      DB::beginTransaction();

      $saved = $produto->delete();

      if (!$saved){
        throw new Exception('Falha ao remover este Produto!');
      }
      DB::commit();
      // se chegou aqui é pq deu tudo certo
      return redirect()->back()->with('success', 'Produto #' . $produto->id . ' removido com sucesso!');
    } catch (Exception $e) {
			DB::rollBack();

      return redirect()->back()->with('error', $e->getMessage());
    }
  }
}

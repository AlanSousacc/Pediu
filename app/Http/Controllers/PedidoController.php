<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use DB;

use App\Models\{
    Configuracao,
    Movimentacao,
  Entregador,
  Pedidos,
  Contato,
  Produto,
};
use Auth;

class PedidoController extends Controller
{

  protected $repository;

  public function __construct(Pedidos $pedidos)
  {
    $this->repository = $pedidos;
  }

  public function index()
  {
    $user = Auth::user()->empresa_id;
    $consulta   = $this->repository->where('empresa_id', $user)->paginate();
    $pedido     = $this->repository->where('empresa_id', $user)->get();
    $entregador = Entregador::where('empresa_id', $user)->get();
    $config     = Configuracao::where('empresa_id', $user)->first();

    return view('pages.pedidos.listagemPedidos', compact('consulta', 'entregador', 'pedido', 'config'));
  }

  // detalha o pedido solicitado e leva para a tela de detalhes do pedido
  public function detalhePedido($id)
  {
    $pedido = $this->repository->find($id);
    return view('pages.pedidos.detalhePedido', compact('pedido'));
  }

  // função para aplicar o status do pedido, entregador do pedido.
  public function aplicarStatus(Request $request)
  {
    $data = $request->except('_token');
    try{
      $pedido  = $this->repository->findOrFail($data['pedidoid']);
      $mov     = Movimentacao::where('pedido_id', $pedido->id)->first();
      $total   = $pedido->total;

      if(isset($data['entregador_id'])){
        $pedido->entregador_id = $data['entregador_id'];
      }

      if($data['troco'] == null){
        $pedido->valortroco == 0;
      } else{
        $pedido->valortroco = $data['troco'];
        $mov->valortotal    = $total + $data['troco'];
        $savedmov           = $mov->save();
      }

    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
      exit();
    }

    try{
      DB::beginTransaction();

      $saved = $pedido->save();

      if (!$saved)
      throw new Exception('Falha ao aplicar status deste Pedido!');

      DB::commit();
      return redirect()->back()->with('success', 'Status do pedido aplicado sucesso!');

    } catch (Exception $e) {

      DB::rollBack();
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  // cria a tela de novo pedido com os dados do banco.
  public function create(){
    $user         = Auth::user()->empresa_id;
    $consulta     = $this->repository->whereDay('created_at', date('d'))->orderby('created_at', 'desc')->paginate(10);
    $resumo       = $this->repository->where('pedidos.created_at', '>=', Carbon::now()->sub('hour', 12))->get();
    $resumoEntre  = DB::table('pedidos')
    ->join('entregadores', 'entregadores.id', '=', 'pedidos.entregador_id')
    ->select('entregadores.nome as nomeEntregador', (DB::raw('sum(pedidos.total) as somaTotal')))
    ->where('pedidos.created_at', '>=', Carbon::now()->sub('hour', 12))
    ->where('pedidos.statusentrega', 0)
    ->groupBy('pedidos.entregador_id')
    ->get();

    $movimentacao = Movimentacao::all();
    $contatos     = Contato::all();
    $entregador   = Entregador::all();
    $produtos     = Produto::all();
    $config     = Configuracao::where('empresa_id', $user)->first();

    return view('pages.pedidos.novoPedido', compact('resumoEntre', 'resumo', 'contatos', 'entregador', 'produtos', 'consulta', 'movimentacao', 'config'));
  }

  /**
  * Esta função foi projetada para salvar o pedido em questão e também associar os itens do pedido
  * ao pedido atual. Criar uma movimentação para que haja necessidade futuramente de conferencia,
  * como se fosse um caixa.
  */
  public function store(Request $request)
  {
    $data = $request->except('_token');

    if(count($data['produtos_listagem_id']) < count($data['produtos_qtde']))
      return redirect()->back()->with('error', 'Quantidade de itens diferente de quantidade de unidade!');

    try{
      // dados do pedido
      $pedido             = new Pedidos;
      $pedido->empresa_id = Auth::user()->empresa_id;
      $pedido->observacao = $data['observacao'];
      $pedido->desconto   = $data['desconto'] != null ? $data['desconto'] : 0;

      $pedido->local_pagamento    = $data['local_pagamento'];
      $pedido->forma_pagamento    = $data['forma_pagamento'];
      $pedido->contato_id         = $data['contato_id'];
      $pedido->total              = $data['total'] + $pedido->desconto;
      $pedido->subtotal           = $pedido->total - $pedido->desconto;
      if($pedido->forma_pagamento == 'Conta do Cliente') {
        $pedido->valortroco       = 0;
        $pedido->devolvertroco    = 0;
      } else {
        if($data['troco'] == 0){
          $pedido->valortroco     = 0;
          $pedido->devolvertroco  = 0;
        } else {
          $pedido->valortroco     = $data['troco'];
          $pedido->devolvertroco  = $data['troco'] - $pedido->subtotal;
        }
      }
      $pedido->endereco_id        = $data['entrega_id'];
      $pedido->statusentrega      = 0;

    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
      exit();
    }

    try{
      DB::beginTransaction();
      $pedidosaved = $pedido->save();

      // aplica o pedido na movimentação
      $mov                  = new Movimentacao;
      $mov->tipo            = 'Entrada';
      $mov->empresa_id      = Auth::user()->empresa_id;
      $mov->forma_pagamento = $pedido->forma_pagamento;
      $mov->valortotal      = $pedido->valortroco != null ? $pedido->total + $pedido->valortroco : $pedido->total;
      $mov->valorrecebido   = 0;
      $mov->valorpendente   = $mov->valortotal;
      $pedido->local_pagamento == 'Local de Entrega' ? $mov->status = 0 : $mov->status = 1;
      $mov->pedido_id       = $pedido->id;
      $mov->contato_id      = $pedido->contato_id;

      $movisaved = $mov->save();
      if (!$movisaved)
      return redirect()->back()->with('error', 'Falha ao salvar Movimentação!');

      // dados do pedidoproduto
      foreach($data['produtos_listagem_id'] as $i => $produto_id ){
        $qtde    = $data['produtos_qtde'][$i];
        $obsitem = $data['obsitem'][$i];
        $prvenda = $data['prvenda'][$i];

        $pedido->produtos()->attach([
          $produto_id => ['qtde' => $qtde, 'obsitem' => $obsitem, 'prvenda' => $prvenda]
        ]);
      }

      if (!$pedidosaved)
        return redirect()->back()->with('error', 'Falha ao salvar Pedido!');

      DB::commit();
      return redirect()->back()->with('pedido', $pedido->id);

    } catch (Exception $e) {

      DB::rollBack();
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  // tela de alteração do pedido
  public function edit($id)
  {
    $pedido   = $this->repository->find($id);
    $contatos = Contato::all();
    $produtos = Produto::all();

    return view('pages.pedidos.editar', compact('pedido', 'contatos', 'produtos'));
  }

  /**
  * Esta função foi projetada para salvar o pedido em questão e também associar os itens do pedido
  * ao pedido atual. Criar uma movimentação para que haja necessidade futuramente de conferencia,
  * como se fosse um caixa.
  */
  public function update(Request $request, $id)
  {
    $data = $request->except('_token');

    if(count($data['produtos_listagem_id']) < count($data['produtos_qtde']))
    return redirect()->back()->with('error', 'Quantidade de itens diferente de quantidade de unidade!');

    try{

      $pedido                  = $this->repository->findOrFail($id);
      $pedido->observacao      = $data['observacao'];
      $pedido->desconto        = $data['desconto'] != null ? $data['desconto'] : 0;
      $pedido->local_pagamento = $data['local_pagamento'];
      $pedido->forma_pagamento = $data['forma_pagamento'];
      $pedido->contato_id      = $data['contato_id'];
      $pedido->total           = $data['total'] + $pedido->desconto;
      $pedido->subtotal        = $pedido->total - $pedido->desconto;
      $pedido->valortroco      = $data['troco'];
      $pedido->devolvertroco   = $data['troco'] - $pedido->subtotal;
      $pedido->endereco_id     = $data['entrega_id'];
      $pedido->statusentrega   = 0;

    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
      exit();
    }

    try{
      DB::beginTransaction();

      $saved = $pedido->save();

      // aplica o pedido na movimentação
      $mov                  = Movimentacao::where('pedido_id', $pedido->id)->first();
      $mov->tipo            = 'Entrada';
      $mov->forma_pagamento = $pedido->forma_pagamento;
      $mov->valortotal      = $pedido->total;
      $mov->valorrecebido   = 0;
      $mov->valorpendente   = $mov->valortotal;
      $mov->status          = 0; //emaberto, aguardando entregador
      $mov->pedido_id       = $pedido->id;
      $mov->contato_id      = $pedido->contato_id;

      $savemovi = $mov->save();
      if (!$savemovi)
      return redirect()->back()->with('error', 'Falha ao alterar o Pedido e Movimentação!');

      $produtos = [];

      $qtde = 0;

      $pedido->produtos()->detach();

      foreach($data['produtos_listagem_id'] as $i => $produto_id ){
        $qtde    = $data['produtos_qtde'][$i];
        $obsitem = $data['obsitem'][$i] != "null" ? $data['obsitem'][$i] : null;
        $prvenda = $data['prvenda'][$i];

        $pedido->produtos()->attach([
          $produto_id => ['qtde' => $qtde, 'obsitem' => $obsitem, 'prvenda' => $prvenda]
        ]);
      }

      if (!$saved)
      return redirect()->back()->with('error', 'Falha ao alterar o Pedido!');

      DB::commit();
      return redirect()->back()->with('success', 'Pedido alterado com sucesso!');

    } catch (Exception $e) {

      DB::rollBack();
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function destroy(Request $request)
  {
    try{
      $pedido = $this->repository->find($request->pedido_id);
      $mov    = Movimentacao::where('pedido_id', $pedido->id)->first();

      $savedmov = $mov->delete();
      if (!$savedmov){
        return redirect()->back()->with('error', 'Falha ao remover a movimentação!');
      }

      if (!$pedido)
      return redirect()->back()->with('error', "Nenhum Pedido encontrado!");

      if ($pedido->statusentrega == 3)
      return redirect()->back()->with('error', "Este pedido não pode ser removido pois já foi entregue!");

      $pedido->produtos()->detach();

    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
      exit();
    }

    try{
      DB::beginTransaction();

      $saved = $pedido->delete();

      if (!$saved){
        return redirect()->back()->with('error', 'Falha ao remover este pedido!');
      }
      DB::commit();
      // se chegou aqui é pq deu tudo certo
      return redirect()->back()->with('success', 'Pedido #' . $pedido->id . ' removido com sucesso!');
    } catch (Exception $e) {
      DB::rollBack();

      return redirect()->back()->with('error', $e->getMessage());
    }
  }

    public function resumoPeriodo(Request $request)
  {
    $data = $request->except('_toquen');

    if(!empty($data['dtstart']) && !empty($data['dtstart'])){
      $data['dtstart'] = Carbon::parse($data['dtstart'])->format('Y-d-m H:m:s');
      $data['dtend'] 	 = Carbon::parse($data['dtend'])->format('Y-d-m H:m:s');
    }

    if(isset($data['dtstart']) && isset($data['dtend'])){
      $resumo      = $this->repository->whereBetween('created_at', [$data['dtstart'], $data['dtend']])->get();
      $resumoEntre = DB::table('pedidos')
      ->join('entregadores', 'entregadores.id', '=', 'pedidos.entregador_id')
      ->select('entregadores.nome as nomeEntregador', (DB::raw('sum(pedidos.total) as somaTotal')))
      ->whereBetween('pedidos.created_at', [$data['dtstart'], $data['dtend']])
      ->where('pedidos.statusentrega', 0)
      ->groupBy('pedidos.entregador_id')
      ->get();
    } else {
      $resumo      = $this->repository->where('created_at', Carbon::now()->sub('hour', 12))->get();
      $resumoEntre = DB::table('pedidos')
      ->join('entregadores', 'entregadores.id', '=', 'pedidos.entregador_id')
      ->select('entregadores.nome as nomeEntregador', (DB::raw('sum(pedidos.total) as somaTotal')))
      ->where('pedidos.created_at', '>=', Carbon::now()->sub('hour', 12))
      ->where('pedidos.statusentrega', 0)
      ->groupBy('pedidos.entregador_id')
      ->get();
    }

    $contatos     = Contato::all();
    $entregador   = Entregador::all();
    $produtos     = Produto::all();
    $movimentacao = Movimentacao::all();
    $consulta     = $this->repository->whereDay('created_at', date('d'))->orderby('created_at', 'desc')->paginate(10);

    return view('pages.pedidos.novoPedido', compact('movimentacao', 'resumo', 'contatos', 'entregador', 'produtos', 'consulta', 'resumoEntre'));
  }

  // após finalizar pedido e clicar em imprimir
  public function imprimirPedido($id)
  {
    $pedido = $this->repository->find($id);

    return view('pages.pedidos.pdf.order', compact('pedido'));
  }

  // ao clicar em detalhar pedidoe clicar em imprimir
  public function print($id)
  {
    $pedido = $this->repository->find($id);

    return view('pages.pedidos.pdf.order', compact('pedido'));
  }
}

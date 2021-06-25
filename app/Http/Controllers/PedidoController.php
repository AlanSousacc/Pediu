<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use Auth;
use DB;

use App\Models\{
  ComplementoItemPedido,
  Configuracao,
  Movimentacao,
  Entregador,
  Pedidos,
  Contato,
  Endereco,
  Grupo,
  MeioameioItemPedido,
    PedidoProduto,
    Produto,
};

class PedidoController extends Controller
{
  protected $repository, $entregador, $config;

  public function __construct(Pedidos $pedidos, Entregador $entregador, Configuracao $config)
  {
    $this->repository = $pedidos;
    $this->entregador = $entregador;
    $this->config     = $config;
  }

  public function index()
  {
    $user = Auth::user()->empresa_id;
    $consulta   = $this->repository->where('empresa_id', $user)->orderBy('created_at', 'desc')->whereDate('created_at', today())->paginate();
    $entregador = $this->entregador->where('empresa_id', $user)->get();
    $config     = Configuracao::where('empresa_id', $user)->first();

    return view('pages.pedidos.listagemPedidos', compact('consulta', 'entregador', 'config'));
  }

  public function filterstatus($status)
  {
    $user       = Auth::user()->empresa_id;
    $consulta   = $this->repository->where('empresa_id', $user)->with('endereco')->orderBy('created_at', 'desc')->where('statuspedido', $status)->paginate(10);
    $entregador = $this->entregador->where('empresa_id', $user)->get();
    $config     = Configuracao::where('empresa_id', $user)->first();
    return view('pages.pedidos.listagemPedidos', compact('config', 'consulta', 'entregador'));
  }

  public function filtrodia($dia)
  {
    $user       = Auth::user()->empresa_id;
    $consulta   = $this->repository->where('empresa_id', $user)->with('endereco')->orderBy('created_at', 'desc')->whereDate('created_at', date($dia))->paginate(10);
    $entregador = $this->entregador->where('empresa_id', $user)->get();
    $config     = $this->config->where('empresa_id', $user)->first();
    return view('pages.pedidos.listagemPedidos', compact('consulta', 'config', 'entregador'));
  }

  // detalha o pedido solicitado e leva para a tela de detalhes do pedido
  public function detalhePedido($id)
  {
    $pedido = $this->repository->with('itenspedidos', 'complementositenspedido', 'meioameioitempedido', 'itenspedidos')->find($id);
    return view('pages.pedidos.detalhePedido', compact('pedido'));
  }

  // aplica status do pedido
  public function aplicarStatusBalcao(Request $request)
  {
    $data     = $request->except('_token');
    $pedido   = $this->repository->where('empresa_id', Auth::user()->empresa_id)->with('endereco')->find($data['pedidoid']);
    $url      = 'https://api.whatsapp.com/send?phone=55'.preg_replace("/[^a-zA-Z0-9]+/", "", $pedido->endereco->telefone).'&text='.$data['campomsg'];

    $save = $pedido->update(array('statuspedido' => $data['status']));
    if (!$save)
      return redirect()->back()->with('error', 'Houve problemas ao salvar esta alteração!');

    $dados = ['url' => $url];
    return response()->json($dados, 200);
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
    $user     = Auth::user()->empresa_id;
    $contatos = Contato::where('empresa_id', $user)->get();
    $produtos = Produto::where('empresa_id', $user)->where('status', 1)->get();
    $grupos   = Grupo::where('empresa_id', $user)->with('empresa')->get();
    $config   = $this->config->where('empresa_id', $user)->first();

    return view('pages.pedidos.balcao.novaTelaPedido', compact('contatos', 'produtos', 'grupos', 'config'));
  }

  public function processaPedidoBalcao(Request $request)
  {
    $data   = $request->all();
    $user   = Auth::user()->empresa_id;
    $config = $this->config->where('empresa_id', $user)->first();

    try{
      // dados do contato caso não tenha cadastro
      if(!$data['contato_id']){
        $contato             = new Contato;
        $contato->nome       = $data['novocliente']['nome'];
        $contato->documento  = $data['novocliente']['documento'];
        $contato->telefone   = $data['novocliente']['telefone'];
        $contato->tipo       = 'Cliente';
        $contato->ativo      = 1;
        $contato->empresa_id = $user;

        $savecontato = $contato->save();
        if (!$savecontato)
        return response()->json(['resposta' => [ 'error' => 'Falha ao salvar os dados do cliente, por isso o pedido não foi finallizado, tente novamente ou contate o suporte!']]);
      }

      // dados do endereço de entrega caso nao tenha cadastro
      if(!$data['endereco_id']){
        $endereco                   = new Endereco;
        $endereco->endereco         = $data['novocliente']['endereco'];
        $endereco->numero           = $data['novocliente']['numero'];
        $endereco->bairro           = $data['novocliente']['bairro'];
        $endereco->cidade           = $data['novocliente']['cidade'];
        $endereco->observacao       = $data['novocliente']['observacao'];
        $endereco->cep              = $data['novocliente']['cep'];
        $endereco->telefone_entrega = $data['novocliente']['telefone_entrega'];
        $endereco->status           = 1;
        $endereco->principal        = 1;
        $endereco->contato_id       = !$data['contato_id'] ? $contato->id : $data['contato_id'];
        $endereco->empresa_id       = $user;

        $saveendereco = $endereco->save();

        if (!$saveendereco)
        return response()->json(['resposta' => [ 'error' => 'Falha ao salvar endereço de entrega, por isso o pedido não foi finallizado, tente novamente ou contate o suporte!']]);
      }

      // dados do pedido
      $pedido                     = new Pedidos;
      $pedido->empresa_id         = $user;
      $pedido->observacao         = $data['pagamento']['observacao'];
      $pedido->desconto           = str_replace (',', '.', str_replace ('.', '', $data['pagamento']['desconto']));
      $pedido->local_pagamento    = $data['pagamento']['local_pagamento'];
      $pedido->forma_pagamento    = $data['pagamento']['forma_pagamento'];
      $pedido->contato_id         = !$data['contato_id'] ? $contato->id : $data['contato_id'];
      $pedido->total              = floatval($data['pagamento']['total']);
      $pedido->taxaentrega        = str_replace (',', '.', str_replace ('.', '', $data['pagamento']['taxaentrega']));
      $pedido->subtotal           = $pedido->total - $pedido->taxaentrega;
      if($pedido->forma_pagamento == 'Conta do Cliente') {
        $pedido->valortroco       = 0;
        $pedido->devolvertroco    = 0;
      } else {
        if($data['pagamento']['valortroco'] == 0){
          $pedido->valortroco     = 0;
          $pedido->devolvertroco  = 0;
        } else {
          $pedido->valortroco     = floatval($data['pagamento']['valortroco']);
          $pedido->devolvertroco  = floatval($data['pagamento']['valortroco']) - $pedido->total;
        }
      }
      $pedido->endereco_id        = !$data['endereco_id'] ? $endereco->id : $data['endereco_id'];
      $pedido->statuspedido       = 0; //0 pendente | 1 aprovado | 2 em andamento | 3 saiu p entrega | 4 entregue | 5 cancelado

    } catch (Exception $e) {
      return response()->json(['resposta' => [ 'error' => $e]]);
      exit();
    }

  try{
    DB::beginTransaction();
    $pedidosaved = $pedido->save();

    // aplica o pedido na movimentação
    $mov                  = new Movimentacao;
    $mov->tipo            = 'Entrada';
    $mov->empresa_id      = $user;
    $mov->forma_pagamento = $pedido->forma_pagamento;
    $mov->valortotal      = $pedido->valortroco != null ? $pedido->total + $pedido->valortroco : $pedido->total;
    $mov->valorpendente   = $mov->valortotal;
    $mov->origem          = 'balcao';

    if($pedido->forma_pagamento == 'Conta do Cliente'){
      $mov->status = 0;
      $mov->valorrecebido = 0;
    } else {
      $mov->status = 1;
      $mov->valorrecebido = $mov->valortotal;
    }

    $mov->pedido_id       = $pedido->id;
    $mov->contato_id      = !$data['contato_id'] ? $contato->id : $data['contato_id'];

    $movisaved = $mov->save();
    if (!$movisaved)
    return response()->json(['resposta' => [ 'error' => 'Falha ao salvar movimentação deste pedido']]);

    // dados do pedidoproduto
    foreach($data['itemsPedido'] as $i => $produto_id){
      $pedprod              = new PedidoProduto();
      $pedprod->pedido_id   = $pedido->id;
      $pedprod->qtde        = $data['itemsPedido'][$i]['qtde'];
      $pedprod->obsitem     = !isset($data['itemsPedido'][$i]['observacao']) ? '' : $data['itemsPedido'][$i]['observacao'];
      $pedprod->prvenda     = floatval($data['itemsPedido'][$i]['preco']);
      $pedprod->produto_id  = $produto_id['iditem'];

      $savepedprod          = $pedprod->save();
      if (!$savepedprod)
        return response()->json(['resposta' => [ 'error' => 'Houve problemas ao registrar item no pedido.']]);


      if(isset($data['itemsPedido'][$i]['adicional'])){
        foreach($data['itemsPedido'][$i]['adicional'] as $adicional){
          $comitped                   = new ComplementoItemPedido;
          $comitped->pedido_id        = $pedido->id;
          $comitped->produto_id       = $adicional['pivot']['produto_id'];
          $comitped->complemento_id   = $adicional['pivot']['complemento_id'];
          $comitped->empresa_id       = $user;
          $comitped->pedidoproduto_id = $pedprod->id;
          $savecomitped               = $comitped->save();
          if (!$savecomitped)
          return response()->json(['resposta' => [ 'error' => 'Houve problemas ao registrar adicional ao produto.']]);
        }
      }

      if(isset($data['itemsPedido'][$i]['sabores'])){
        foreach($data['itemsPedido'][$i]['sabores'] as $meiomeio){
          $meioameio                   = new MeioameioItemPedido;
          $meioameio->pedido_id        = $pedido->id;
          $meioameio->produto_id       = $meiomeio['id'];
          $meioameio->empresa_id       = $user;
          $meioameio->pedidoproduto_id = $pedprod->id;
          $savemeioameio               = $meioameio->save();
          if (!$savemeioameio)
          return response()->json(['resposta' => [ 'error' => 'Houve problemas ao registrar meio a meio']]);
        }
      }
    }

    if (!$pedidosaved)
      return response()->json(['resposta' => [ 'error' => 'Falha ao salvar este pedido']]);

    DB::commit();
      return response()->json(['resposta' => [ 'success' => 'Pedido Registrado com Sucesso!', 'pedidoid' => $pedido->id]]);

    } catch (Exception $e) {
      DB::rollBack();
      return response()->json(['resposta' => [ 'error' => 'Falha ao registrar o pedido, tente novamente, caso o erro persista contate o suporte!']]);
    }
  }

  // Leva para a tela de editar o pedido com o id
  public function editar($id)
  {
    $user        = Auth::user()->empresa_id;
    $contatos    = Contato::where('empresa_id', $user)->get();
    $grupos      = Grupo::where('empresa_id', $user)->get();

    return view('pages.pedidos.balcao.novaTelaPedido', compact('id', 'contatos', 'grupos'));
  }

  // leva os campos via API para a tela de pedidos para editar
  public function edit($id)
  {
    // dd($id);
    $user        = Auth::user()->empresa_id;
    $pedido      = $this->repository->with('meioameioitempedido', 'complementositenspedido.complemento', 'itenspedidos.produtos')->find($id);
    // $complemento = ComplementoItemPedido::where('pedido_id', $id)->get();
    // $meioameio   = MeioameioItemPedido::where('pedido_id', $id)->get();
    // $itempedido  = PedidoProduto::where('pedido_id', $id)->get();

    // return response()->json(['pedido' => $pedido, 'complemento' => $complemento, 'meioameio' => $meioameio, 'itempedido' => $itempedido]);
    return response()->json(['pedido' => $pedido]);
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
      $user   = Auth::user()->empresa_id;
      $pedido = $this->repository->where('empresa_id', $user)->find($request->pedido_id);
      $mov    = Movimentacao::where('pedido_id', $pedido->id)->where('empresa_id', $user)->first();

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

  // após finalizar pedido e clicar em imprimir
  public function imprimirPedido($id)
  {
    $pedido = $this->repository->where('empresa_id', Auth::user()->empresa_id)->find($id);

    return view('pages.pedidos.pdf.order', compact('pedido'));
  }

  // ao clicar em detalhar pedidoe clicar em imprimir
  public function print($id)
  {
    $pedido = $this->repository->where('empresa_id', Auth::user()->empresa_id)->find($id);
    return view('pages.pedidos.pdf.order', compact('pedido'));
  }
}

<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use App\Models\Contato;
use App\Models\FluxoMovimentacao;
use Illuminate\Http\Request;
use App\Models\Movimentacao;
use App\Models\Pedidos;
use Exception;
use DB;
use Illuminate\Support\Facades\Auth;

class MovimentacaoController extends Controller
{
  // private $fluxodia;
  public function resultadoFluxo()
  {
    $fluxo = FluxoMovimentacao::where('empresa_id', Auth::user()->empresa_id)->whereDate('created_at', today())->get();
    $resultados['entradas'] = $entradas = $fluxo->where('tipo', 'Recebimento')->sum('valor');
    $resultados['saidas']   = $saidas   = $fluxo->where('tipo', 'Pagamento')->sum('valor');
    $resultados['fluxodia'] = $entradas - $saidas;

    return $resultados;
  }

  public function caixa()
  {
    $empresa_id   = Auth::user()->empresa_id;
    $config       = Configuracao::where('empresa_id', $empresa_id)->first();
    $contatos     = Contato::where('empresa_id', $empresa_id)->get();
    $movimentacao = Movimentacao::where('empresa_id', $empresa_id)->whereDate('created_at', today())->with('pedido')->get();
    $totais['dinheirobalc'] = $movimentacao->where('origem', 'balcao')->where('forma_pagamento', 'Dinheiro')->sum('valortotal');
    $totais['cardcredbalc'] = $movimentacao->where('origem', 'balcao')->where('forma_pagamento', 'Cartão de Crédito')->sum('valortotal');
    $totais['carddebibalc'] = $movimentacao->where('origem', 'balcao')->where('forma_pagamento', 'Cartão de Débito')->sum('valortotal');
    $totais['contaclibalc'] = $movimentacao->where('origem', 'balcao')->where('forma_pagamento', 'Conta do Cliente')->sum('valortotal');

    $totais['dinheiroloja'] = $movimentacao->where('origem', 'loja')->where('forma_pagamento', 'Dinheiro')->sum('valortotal');
    $totais['cardcredloja'] = $movimentacao->where('origem', 'loja')->where('forma_pagamento', 'Cartão de Crédito')->sum('valortotal');

    $fluxomovimentacao = $this->resultadoFluxo();
    $pedidos = DB::table('pedidos')
      ->join('entregadores', 'entregadores.id', 'pedidos.entregador_id')
      ->select((DB::raw('entregadores.nome as nome, sum(pedidos.total) as total')))
      ->where('entregador_id', '!=', null)
      ->where('forma_pagamento', '!=', 'Conta do Cliente')
      ->whereDate('pedidos.created_at', today())
      ->groupBy('entregadores.id')
      ->get();

    return view('pages.financeiro.caixa', compact('fluxomovimentacao','config', 'totais', 'contatos', 'pedidos'));
  }

  // Tela de movimentação de recebimento financeiros por dia
  public function recebimentosDia()
  {
    $fluxos = FluxoMovimentacao::where('empresa_id', Auth::user()->empresa_id)->with('movimentacao')->where('tipo', 'Recebimento')->whereDate('created_at', today())->paginate();
    return view('pages.financeiro.recebimentosDia', compact('fluxos'));
  }

  // Tela de movimentação de pagamentos financeiros por dia
  public function pagamentosDia()
  {
    $fluxos = FluxoMovimentacao::where('empresa_id', Auth::user()->empresa_id)->with('movimentacao')->where('tipo', 'Pagamento')->whereDate('created_at', today())->paginate();
    return view('pages.financeiro.pagamentosDia', compact('fluxos'));
  }

  // Tela de movimentação de recebimentos financeiros geral sem filtro
  public function movimentacoesrecebimentos()
  {
    $movimentacao = Movimentacao::where('empresa_id', Auth::user()->empresa_id)->where('tipo', 'Entrada')->with('pedido','contato')->paginate(15);
    $fluxomovi    = FluxoMovimentacao::where('empresa_id', Auth::user()->empresa_id)->get();

    return view('pages.financeiro.movimentacaoRecebimentos', compact('movimentacao', 'fluxomovi'));
  }

  // Tela de movimentação de pagamentos financeira geral sem filtro
  public function movimentacoespagamentos()
  {
    $movimentacao = Movimentacao::where('empresa_id', Auth::user()->empresa_id)->where('tipo', 'Saída')->with('pedido','contato')->paginate();
    $fluxomovi    = FluxoMovimentacao::where('empresa_id', Auth::user()->empresa_id)->get();

    return view('pages.financeiro.movimentacaoPagamentos', compact('movimentacao', 'fluxomovi'));
  }

  public function show($tipo)
  {
    $contatos     = Contato::where('empresa_id', Auth::user()->empresa_id)->get();

    return view('pages.financeiro.create', compact('contatos', 'tipo'));
  }

  public function detalhe($id)
  {
    $movimentacao = Movimentacao::where('empresa_id', Auth::user()->empresa_id)->where('id', $id)->first();
    $fluxomovi    = FluxoMovimentacao::where('empresa_id', Auth::user()->empresa_id)->where('movimentacao_id', $id)->get();

    return view('pages.financeiro.detalheFinanceiro', compact('movimentacao', 'fluxomovi'));
  }

  public function movimentar(Request $request){
    $data       = $request->except('_token');
    $empresa_id = Auth::user()->empresa_id;

    // se existir um id de movimentação, ele irá receber de um cliente pela tela financeiro do cliente
    if(isset($data['movimentacaoid'])){
      try{
        $mov = Movimentacao::findOrFail($data['movimentacaoid']);
  
        if (!$mov)
          throw new Exception("Nenhuma Movimentação encontrada");
  
        if(floatval($data['valorpendente']) > $mov->valortotal - $mov->valorrecebido){
          throw new Exception('O valor informado excede o valor restante a ser recebido!');
        }

        $fluxo                      = new FluxoMovimentacao;
        $fluxo->tipo                = $data['tipomovimentacao'] == 'Pagamento' ? 'Pagamento' : 'Recebimento';
        $fluxo->forma_movimentacao  = $data['formarecebimento'];
        $fluxo->valortotal          = $mov->valortotal;
        $fluxo->valor               = $data['valorpendente'];
        $fluxo->empresa_id          = $empresa_id;
        $fluxo->movimentacao_id     = $mov->id;
  
        $salvarfluxo = $fluxo->save();
  
        $mov->valorrecebido  += $data['valorpendente'];
        $mov->valorpendente  = $mov->valortotal - $mov->valorrecebido;
  
        if($mov->valorrecebido < $mov->valortotal){
          $mov->status  = 0;
        } else {
          $mov->status  = 1;
        }
  
        $saved = $mov->save();
  
      } catch (Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
        exit();
      }
  
      try{
        DB::beginTransaction();
  
        if (!$saved){
          throw new Exception('Falha ao aplicar recebimento!');
        }
  
        DB::commit();
        return redirect()->back()->with('success', 'Valor recebido com sucesso!');
  
      } catch (Exception $e) {
  
        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
      }
    }

    // faz movimentação avulsa entrada ou saída
    try{
    $movi                = new Movimentacao;
    $movi->tipo          = $data['tipo'] == 'Saída' ? 'Saída' : 'Entrada';
    $movi->valortotal    = $data['valortotal'];
    $movi->valorrecebido = $data['valorrecebido'];
    $movi->valorpendente = $data['valorrecebido'] == $data['valortotal'] ? 0 : $data['valortotal'] - $data['valorrecebido'];
    $movi->status        = $movi->valorpendente == 0 ? 1 : 0;
    $movi->contato_id    = $data['contato_id'] == 0 ? null : $data['contato_id'];
    $movi->empresa_id    = $empresa_id;
    $movi->origem        = 'avulso';
    $movi->observacao    = $data['observacao'];

    $saved = $movi->save();

    $fluxo                      = new FluxoMovimentacao;
    $fluxo->tipo                = $data['tipo'] == 'Entrada' ? 'Recebimento' : 'Pagamento';
    $fluxo->forma_movimentacao  = $data['forma_pagamento'];
    $fluxo->valortotal          = $movi->valortotal;
    $fluxo->valor               = $movi->valorrecebido;
    $fluxo->empresa_id          = $empresa_id;
    $fluxo->movimentacao_id     = $movi->id;

    $salvarfluxo = $fluxo->save();

    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
      exit();
    }

    try{
      DB::beginTransaction();

      if (!$saved && !$salvarfluxo)
        return redirect()->back()->with('error', 'Falha ao realizar movimentação!');

      DB::commit();
      return redirect()->back()->with('success', 'Movimentação realizada com sucesso!');

    } catch (Exception $e) {

      DB::rollBack();
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  // Aplica a baixa TOTAL do valor que está na movimentação
  public function baixarMovimentacao(Request $request)
  {
    try {
      $data = $request->except('_token');
      $mov = Movimentacao::where('pedido_id', $data['pedido_id'])->where('empresa_id', Auth::user()->empresa_id)->first();

      $mov->status = 1;
      $mov->valorrecebido = $data['valorpedido'];
      $mov->valorpendente = 0;

    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
      exit();
    }
    try {
      DB::beginTransaction();

      $saved = $mov->save();

      if (!$saved)
      throw new Exception('Falha ao Baixar valor do entregador!');

      DB::commit();
      return redirect()->back()->with('success', 'Baixa aplicada com sucesso!');

    } catch (Exception $e) {

      DB::rollBack();
      return redirect()->back()->with('error', $e->getMessage());
    }

  }
}

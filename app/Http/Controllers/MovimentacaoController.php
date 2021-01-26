<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimentacao;
use App\Models\Pedidos;
use Exception;
use DB;
use Illuminate\Support\Facades\Auth;

class MovimentacaoController extends Controller
{
  public function receber(Request $request){
    $data = $request->except('_token');

    try{
      $mov = Movimentacao::findOrFail($data['movimentacaoid']);

      if (!$mov)
        throw new Exception("Nenhuma Movimentação encontrada");

        // dd($data);
      if(floatval($data['valorpendente']) > $mov->valortotal - $mov->valorrecebido){
        throw new Exception('O valor informado excede o valor restante a ser recebido!');
      }

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

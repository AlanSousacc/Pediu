<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Configuracao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidosLojaController extends Controller
{
  public function index()
  {
    $pedidos = Cart::where('empresa_id', Auth::user()->empresa_id)->with('endereco')->orderBy('statuspedido', 'asc')->whereDate('created_at', today())->paginate(10);
    $config  = Configuracao::where('empresa_id', Auth::user()->empresa_id)->first();
    return view('pages.pedidos.loja.listagemPedidosLoja', compact('pedidos', 'config'));
  }

  public function filterstatus($status)
  {
    $pedidos = Cart::where('empresa_id', Auth::user()->empresa_id)->with('endereco')->where('statuspedido', $status)->whereDate('created_at', today())->paginate(10);
    $config  = Configuracao::where('empresa_id', Auth::user()->empresa_id)->first();
    return view('pages.pedidos.loja.listagemPedidosLoja', compact('pedidos', 'config'));
  }

  public function aplicarStatus(Request $request)
  {
    $data = $request->except('_token');
    $pedidos = Cart::where('empresa_id', Auth::user()->empresa_id)->with('endereco')->where('id', $data['pedidoid'])->first();

    $save = $pedidos->update(array('statuspedido' => $data['status']));

    if (!$save)
      return redirect()->back()->with('error', 'Houve problemas ao salvar esta alteração!');

    return redirect()->back()->with('success', 'Status alterado com sucesso!');
  }
}

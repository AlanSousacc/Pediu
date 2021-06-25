<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Configuracao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidosLojaController extends Controller
{
  protected $repository;

  public function __construct(Cart $pedidos)
  {
    $this->repository = $pedidos;
  }

  public function index()
  {
    $pedidos = $this->repository->where('empresa_id', Auth::user()->empresa_id)->with('endereco')->orderBy('statuspedido', 'asc')->whereDate('created_at', today())->paginate(10);
    $config  = Configuracao::where('empresa_id', Auth::user()->empresa_id)->first();
    return view('pages.pedidos.loja.listagemPedidosLoja', compact('pedidos', 'config'));
  }

  public function listagemPedidosLoja()
  {
    $pedidos = $this->repository->where('empresa_id', Auth::user()->empresa_id)->with('endereco')->orderBy('created_at', 'asc')->paginate(10);
    $config  = Configuracao::where('empresa_id', Auth::user()->empresa_id)->first();
    return view('pages.pedidos.loja.listagemPedidosLoja', compact('pedidos', 'config'));
  }

  public function filtrodia($dia)
  {
    $pedidos = $this->repository->where('empresa_id', Auth::user()->empresa_id)->with('endereco')->orderBy('created_at', 'asc')->whereDate('created_at', date($dia))->paginate(10);
    $config  = Configuracao::where('empresa_id', Auth::user()->empresa_id)->first();
    return view('pages.pedidos.loja.listagemPedidosLoja', compact('pedidos', 'config'));
  }

  public function filterstatus($status)
  {
    $pedidos = $this->repository->where('empresa_id', Auth::user()->empresa_id)->with('endereco')->where('statuspedido', $status)->whereDate('created_at', today())->paginate(10);
    $config  = Configuracao::where('empresa_id', Auth::user()->empresa_id)->first();
    return view('pages.pedidos.loja.listagemPedidosLoja', compact('pedidos', 'config'));
  }

  public function aplicarStatus(Request $request)
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

  // detalha o pedido solicitado e leva para a tela de detalhes do pedido
  public function detalhePedidoLoja($id)
  {
    $pedido = $this->repository->with('user')->with('endereco')->with('orderitems')->with('complementositemcart')->with('meioameioitemcart')->find($id);
    return view('pages.pedidos.loja.detalhePedidoLoja', compact('pedido'));
  }

  // ao clicar em detalhar pedidoe clicar em imprimir
  public function printloja($id)
  {
    $pedidoloja = Cart::where('empresa_id', Auth::user()->empresa_id)->with('user')->with('endereco')->with('orderitems')->with('complementositemcart')->find($id);
    // dd($pedidoloja);

    return view('pages.pedidos.pdf.order', compact('pedidoloja'));
  }
}

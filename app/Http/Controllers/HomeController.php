<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  public function __construct()
  {
    // $this->middleware('auth');
  }

  public function index()
  {
    return view('site.index');
    // $user = Auth::user()->empresa_id;

    // $topProductsBalcao = DB::table('pedido_produto')
    //   ->select('produtos.descricao', (DB::raw('sum(pedido_produto.qtde) as qtde')))
    //   ->leftjoin('pedidos', 'pedido_produto.pedido_id', '=', 'pedidos.id')
    //   ->leftjoin('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
    //   ->where('pedidos.empresa_id', $user)
    //   ->groupBy('produtos.id')
    //   ->orderByRaw('sum(pedido_produto.qtde) DESC')
    //   ->limit(5)
    //   ->get();

    // $topProductsLoja = DB::table('cart_items')
    //   ->select('produtos.descricao', (DB::raw('sum(cart_items.qtde) as qtde')))
    //   ->leftjoin('cart', 'cart_items.cart_id', '=', 'cart.id')
    //   ->leftjoin('produtos', 'cart_items.produto_id', '=', 'produtos.id')
    //   ->where('cart.empresa_id', $user)
    //   ->groupBy('produtos.id')
    //   ->orderByRaw('sum(cart_items.qtde) DESC')
    //   ->limit(5)
    //   ->get();

    // $topClientsLoja = DB::table('cart')
    //   ->select('users.name', (DB::raw('count(cart.id) as qtde')))
    //   ->leftjoin('users', 'cart.user_id', '=', 'users.id')
    //   ->where('cart.empresa_id', $user)
    //   ->groupBy('cart.user_id')
    //   ->orderByRaw('count(cart.id) DESC')
    //   ->limit(5)
    //   ->get();

    // $topClientsBalcao = DB::table('pedidos')
    //   ->select('contatos.nome', (DB::raw('count(pedidos.id) as qtde')))
    //   ->leftjoin('contatos', 'pedidos.contato_id', '=', 'contatos.id')
    //   ->where('pedidos.empresa_id', $user)
    //   ->groupBy('pedidos.contato_id')
    //   ->orderByRaw('count(pedidos.id) DESC')
    //   ->limit(5)
    //   ->get();
    // return view('home', compact('topProductsBalcao', 'topProductsLoja', 'topClientsLoja', 'topClientsBalcao'));
  }

  // public function vendasBalcaoMensal()
  // {
  //   $user = Auth::user()->empresa_id;
  //   $pedidosBalcaoMensal = DB::table('pedidos')
  //     ->select(DB::raw('sum(total) as totaldia, DATE_FORMAT(created_at, "%d/%m") as dia'))
  //     ->whereMonth('created_at', date('m'))
  //     ->where('empresa_id', $user)
  //     ->groupBy(DB::raw('date(created_at)'))
  //     ->get();

  //   return response()->json($pedidosBalcaoMensal, 200);
  // }

  // public function vendasLojaMensal()
  // {
  //   $user = Auth::user()->empresa_id;
  //   $pedidosLojaMensal = DB::table('cart')
  //     ->select(DB::raw('sum(totalpedido) as totaldia, DATE_FORMAT(created_at, "%d/%m") as dia'))
  //     ->whereMonth('created_at', date('m'))
  //     ->where('empresa_id', $user)
  //     ->groupBy(DB::raw('date(created_at)'))
  //     ->get();

  //   return response()->json($pedidosLojaMensal, 200);
  // }
  
  // public function topFiveProdutos(){
  //   $user = Auth::user()->empresa_id;

  //   $topProductsBalcao = DB::table('pedido_produto')
  //     ->select('produtos.descricao', (DB::raw('sum(pedido_produto.qtde) as qtde')))
  //     ->leftjoin('pedidos', 'pedido_produto.pedido_id', '=', 'pedidos.id')
  //     ->leftjoin('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
  //     ->where('pedidos.empresa_id', $user)
  //     ->groupBy('produtos.id')
  //     ->orderByRaw('sum(pedido_produto.qtde) DESC')
  //     ->limit(5)
  //     ->get();

  //   $topProductsLoja = DB::table('cart_items')
  //     ->select('produtos.descricao', (DB::raw('sum(cart_items.qtde) as qtde')))
  //     ->leftjoin('cart', 'cart_items.cart_id', '=', 'cart.id')
  //     ->leftjoin('produtos', 'cart_items.produto_id', '=', 'produtos.id')
  //     ->where('cart.empresa_id', $user)
  //     ->groupBy('produtos.id')
  //     ->orderByRaw('sum(cart_items.qtde) DESC')
  //     ->limit(5)
  //     ->get();

  //   return view('home', compact('topProductsBalcao', 'topProductsLoja'));
  // }
}

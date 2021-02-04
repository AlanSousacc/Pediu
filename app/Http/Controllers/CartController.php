<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
  public function addToCart($id)
  {
    $produto = Produto::find($id);
    $user = Auth::user();

    if(!$produto) {
      abort(404);
    }

    $cart = session()->get('cart');

    // se o carrinho estiver vazio, este é o primeiro produto
    if(!$cart) {
      $cart = [
        $id => [
          "item_id" => $produto->id,
          "descricao" => $produto->descricao,
          "composicao" => $produto->composicao,
          "quantity" => 1,
          "precovenda" => $produto->precovenda,
          "foto" => $produto->foto,
          "user" => $user->id
        ]
      ];
      session()->put('cart', $cart);
      return redirect()->back()->with('success', 'Produto adicionado ao carrinho com sucesso!');
    }

    // se o carrinho não estiver vazio, verifique se este produto existe e aumente a quantidade
    if(isset($cart[$id])) {
      $cart[$id]['quantity']++;
      session()->put('cart', $cart);
      return redirect()->back()->with('success', 'Produto adicionado ao carrinho com sucesso');
    }

    // se o item não existe no carrinho, então adicione ao carrinho com a quantidade = 1
    $cart[$id] = [
      "item_id" => $produto->id,
      "descricao" => $produto->descricao,
      "composicao" => $produto->composicao,
      "quantity" => 1,
      "precovenda" => $produto->precovenda,
      "foto" => $produto->foto,
      "user" => $user->id
    ];
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Produto adicionado ao carrinho com sucesso!');
  }

  public function update(Request $request)
  {
    if($request->id and $request->quantity){
      $cart = session()->get('cart');
      $cart[$request->id]["quantity"] = $request->quantity;
      session()->put('cart', $cart);
      session()->flash('success', 'Carrinho atualizado com sucesso');
    }
  }


  public function remove(Request $request)
  {
    if($request->id) {
      $cart = session()->get('cart');
      if(isset($cart[$request->id])) {
        unset($cart[$request->id]);
        session()->put('cart', $cart);
      }
      session()->flash('success', 'Produto removido com sucesso!');
    }
  }
}

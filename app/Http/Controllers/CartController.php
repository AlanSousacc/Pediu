<?php

namespace App\Http\Controllers;

use App\Models\Complemento;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
  public function addtocart(Request $request)
  {
    $prod_id          = $request->input('product_id');
    $quantity         = $request->input('quantity');
    $complementos_id  = $request['complementos'];
    $precoitem        = $request->input('precoitem');
    $produtosize      = $request->input('produtosize');
    $observacaoitem   = $request->input('observacaoitem');
    $saboresdiversos  = $request->input('saboresdiversos');

    if(Cookie::get('shopping_cart')) {
      $cookie_data = stripslashes(Cookie::get('shopping_cart'));
      $cart_data = json_decode($cookie_data, true);
    } else {
      $cart_data = array();
    }

      $produto         = Produto::find($prod_id);
      $complementos    = DB::table('complemento_produto')->where('produto_id', $prod_id)->get();
      $prod_name       = $produto->descricao;
      $prod_comp       = $produto->composicao;
      $prod_image      = $produto->foto;
      $item_observacao = $observacaoitem;
      if($precoitem != $produto->$produtosize){
        return response()->json(['message' => 'Preço inválido!'], 404);
      } else {
        $priceval      = $produto->$produtosize;
      }
      if(count($complementos) != 0){
        $complem_produ = $complementos_id;
      } else{
        $complem_produ =  null;
      }

      if($produto){
        $item_array = array(
          'item_id'         => $prod_id,
          'item_name'       => $prod_name,
          'prod_comp'       => $prod_comp,
          'item_quantity'   => $quantity,
          'item_price'      => $priceval,
          'item_image'      => $prod_image,
          'item_observacao' => $item_observacao,
          'user_id'         => Auth::user()->id,
          'empresa_id'      => Auth::user()->empresa->id,
          'complem_produ'   => $complem_produ ? $complem_produ : null,
          'meio_a_meio'     => $saboresdiversos ? $saboresdiversos : null
        );
        $cart_data[] = $item_array;

        $item_data = json_encode($cart_data, JSON_UNESCAPED_UNICODE);

        $minutes = 60;
        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
        return response()->json(['status'=>''.$prod_name.' Foi adicionado ao Carrinho!']);
      }
    // }
  }

  public function updatetocart(Request $request)
  {
    $prod_id  = $request->input('product_id');
    $quantity = $request->input('quantity');

    if(Cookie::get('shopping_cart')){
      $cookie_data = stripslashes(Cookie::get('shopping_cart'));
      $cart_data = json_decode($cookie_data, true);

      $item_id_list = array_column($cart_data, 'item_id');
      $prod_id_is_there = $prod_id;

      if(in_array($prod_id_is_there, $item_id_list)){
        dd($request);
        foreach($cart_data as $keys => $values){
          if($cart_data[$keys]["item_id"] == $prod_id){
            $cart_data[$keys]["item_quantity"] =  $quantity;
            $item_data = json_encode($cart_data);
            $minutes = 60;
            Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
            return response()->json(['status'=>'Item atualizado com Sucesso!']);
          }
        }
      }
    }
  }

  public function deletefromcart(Request $request)
  {
    $prod_id = $request->input('product_id');

    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
    $cart_data = json_decode($cookie_data, true);

    $item_id_list = array_column($cart_data, 'item_id');
    $prod_id_is_there = $prod_id;

    if(in_array($prod_id_is_there, $item_id_list)){
      foreach($cart_data as $keys => $values){
        if($cart_data[$keys]["item_id"] == $prod_id){
          unset($cart_data[$keys]);
          $item_data = json_encode($cart_data);
          $minutes = 60;
          Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
          return response()->json(['status'=>'Produto foi removido do carrinho!']);
        }
      }
    }
  }

  public function clearcart()
  {
    Cookie::queue(Cookie::forget('shopping_cart'));
    return response()->json(['status'=>'Seu carrinho foi limpo!']);
  }
}

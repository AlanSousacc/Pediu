<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\models\CartItems;
use App\Models\Configuracao;
use App\Models\Empresa;
use App\Models\EnderecoUsers;
use App\Models\Grupo;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CatalogoController extends Controller
{
  private $empresa, $produtos, $grupos, $config;
  public function __construct(Empresa $empresa, Grupo $grupos, Produto $produtos, Configuracao $configuracao)
  {
    $this->empresa = $empresa;
    $this->produtos = $produtos;
    $this->grupos = $grupos;
    $this->config = $configuracao;
  }

  public function index($slug)
  {
    $empresa      = $this->empresa::where('slug', $slug)->first();
    $produtos     = $this->produtos::where('empresa_id', $empresa->id)->where('status', 1)->get();
    $grupos       = $this->grupos::where('empresa_id', $empresa->id)->get();
    $cookie_data  = stripslashes(Cookie::get('shopping_cart'));
    $cart_data    = json_decode($cookie_data, true);

    return view('pages.catalogo.index', compact('produtos', 'empresa', 'grupos', 'cart_data'));
  }

  public function grupo($slug, $id)
  {
    $empresa  = $this->empresa::where('slug', $slug)->first();
    $grupos   = $this->grupos::where('empresa_id', $empresa->empresa_id)->get();
    $grupo    = $this->grupos::where('empresa_id', $empresa->empresa_id)->where('id', $id)->first();
    $produtos = $this->produtos::where('empresa_id', $empresa->id)
                         ->where('status', 1)
                         ->where('grupo_id', $id)->get();

    return view('pages.catalogo.index', compact('produtos', 'empresa', 'grupos', 'grupo'));
  }

  public function search($slug, Request $request)
  {
    $data = $request->except('_token');

    $empresa  = $this->empresa::where('slug', $slug)->first();
    $grupos   = $this->grupos::where('empresa_id', $empresa->id)->get();
    $produtos = $this->produtos::where('empresa_id', $empresa->id)
                         ->where('status', 1)
                         ->where('descricao',  'like', '%'.$data['searchfield'].'%')->get();

    return view('pages.catalogo.index', compact('produtos', 'empresa', 'grupos'));
  }

  public function detalheProduto($slug, $id)
  {
    $empresa  = $this->empresa::where('slug', $slug)->first();
    $grupos   = $this->grupos::where('empresa_id', $empresa->id)->get();
    $produto  = $this->produtos::where('empresa_id', $empresa->id)
                         ->where('id', $id)->first();

    return view('pages.catalogo.detalhe-produto', compact('produto', 'empresa', 'grupos'));
  }

  public function cart($slug)
  {
    $empresa     = $this->empresa::where('slug', $slug)->first();
    $grupos      = $this->grupos::where('empresa_id', $empresa->id)->get();
    $produtos    = $this->produtos::where('empresa_id', $empresa->id)->get();
    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
    $cart_data   = json_decode($cookie_data, true);

    return view('pages.catalogo.cart', compact('produtos', 'empresa', 'grupos', 'cart_data'));
  }

  public function checkout($slug)
  {
    $empresa     = $this->empresa::where('slug', $slug)->first();
    $grupos      = $this->grupos::where('empresa_id', $empresa->id)->get();
    $produtos    = $this->produtos::where('empresa_id', $empresa->id)->get();
    $config      = $this->config::where('empresa_id', $empresa->id)->first();
    $endereco    = EnderecoUsers::where('user_id', Auth::user()->id)->where('principal', 1)->first();
    $enderecos   = EnderecoUsers::where('user_id', Auth::user()->id)->get();
    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
    $cart_data   = json_decode($cookie_data, true);

    return view('pages.catalogo.checkout', compact('produtos', 'empresa', 'grupos', 'config', 'cart_data', 'endereco', 'enderecos'));
  }

  public function profile($slug)
  {
    $empresa     = $this->empresa::where('slug', $slug)->first();
    $grupos      = $this->grupos::where('empresa_id', $empresa->id)->get();
    $produtos    = $this->produtos::where('empresa_id', $empresa->id)->get();
    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
    $cart_data   = json_decode($cookie_data, true);

    return view('pages.catalogo.account-profile', compact('produtos', 'empresa', 'grupos', 'cart_data'));
  }

  public function profileAddress($slug)
  {
    $empresa     = $this->empresa::where('slug', $slug)->first();
    $grupos      = $this->grupos::where('empresa_id', $empresa->id)->get();
    $produtos    = $this->produtos::where('empresa_id', $empresa->id)->get();
    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
    $cart_data   = json_decode($cookie_data, true);
    $address     = EnderecoUsers::where('user_id', Auth::user()->id)->get();

    return view('pages.catalogo.account-address', compact('produtos', 'empresa', 'grupos', 'cart_data', 'address'));
  }

  public function profilePedidos($slug)
  {
    $empresa     = $this->empresa::where('slug', $slug)->first();
    $grupos      = $this->grupos::where('empresa_id', $empresa->id)->get();
    $produtos    = $this->produtos::where('empresa_id', $empresa->id)->get();
    $address     = EnderecoUsers::where('user_id', Auth::user()->id)->get();
    $orders      = Cart::where('user_id', Auth::user()->id)->where('empresa_id', $empresa->id)->get();

    return view('pages.catalogo.account-pedidos', compact('produtos', 'empresa', 'grupos', 'address', 'orders'));
  }

  public function PedidoDetail($slug, $id, $pedido)
  {
    $empresa     = $this->empresa::where('slug', $slug)->first();
    $grupos      = $this->grupos::where('empresa_id', $empresa->id)->get();
    $produtos    = $this->produtos::where('empresa_id', $empresa->id)->get();
    $address     = EnderecoUsers::where('user_id', Auth::user()->id)->get();
    $orders     = Cart::where('user_id', Auth::user()->id)->where('empresa_id', $empresa->id)->get();
    $order       = Cart::where('user_id', Auth::user()->id)->where('empresa_id', $empresa->id)->where('id', $pedido)->first();
    // $cart_items  = CartItems::where('user_id', Auth::user()->id)->where('empresa_id', $empresa->id)->where('cart_id', $cart->id)->get();

    return view('pages.catalogo.order-detail', compact('produtos', 'empresa', 'grupos', 'address', 'orders', 'order'));
  }
}

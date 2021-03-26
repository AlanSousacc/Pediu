<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\models\CartItems;
use App\Models\Complemento;
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
  private $totalprodutos  = 0;
  private $totaladicional = 0;
  public function __construct(Empresa $empresa, Grupo $grupos, Produto $produtos, Configuracao $configuracao)
  {
    $this->empresa  = $empresa;
    $this->produtos = $produtos;
    $this->grupos   = $grupos;
    $this->config   = $configuracao;
  }

  public function index($slug)
  {
    // dd('aqui');
    $empresa      = $this->empresa->where('slug', $slug)->first();
    $produtos     = $this->produtos->where('empresa_id', $empresa->id)->where('status', 1)->get();
    $grupos       = $this->grupos->where('empresa_id', $empresa->id)->get();
    $cookie_data  = stripslashes(Cookie::get('shopping_cart'));
    $cart_data    = json_decode($cookie_data, true);

    return view('pages.catalogo.index', compact('produtos', 'empresa', 'grupos', 'cart_data', 'cookie_data'));
  }

  public function grupo($slug, $descricao)
  {
    $empresa  = $this->empresa->where('slug', $slug)->first();
    $grupos   = $this->grupos->where('empresa_id', $empresa->id)->get();
    $grupo    = $this->grupos->where('empresa_id', $empresa->id)->where('descricao', $descricao)->first();
    $produtos = $this->produtos::where('empresa_id', $empresa->id)->where('status', 1)->where('grupo_id', $grupo->id)->get();
    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
    $cart_data   = json_decode($cookie_data, true);

    return view('pages.catalogo.index', compact('produtos', 'empresa', 'grupos', 'grupo', 'cookie_data', 'cart_data'));
  }

  public function search($slug, Request $request)
  {
    $data = $request->except('_token');

    $empresa  = $this->empresa->where('slug', $slug)->first();
    $grupos   = $this->grupos->where('empresa_id', $empresa->id)->get();
    $produtos = $this->produtos->where('empresa_id', $empresa->id)->where('status', 1)->where('descricao',  'like', '%'.$data['searchfield'].'%')->get();
    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
    $cart_data   = json_decode($cookie_data, true);

    return view('pages.catalogo.index', compact('produtos', 'empresa', 'grupos', 'cookie_data', 'cart_data'));
  }

  public function detalheProduto($slug, $id)
  {
    $empresa  = $this->empresa->where('slug', $slug)->first();
    $grupos   = $this->grupos->where('empresa_id', $empresa->id)->get();
    $produto  = $this->produtos->where('empresa_id', $empresa->id)->where('id', $id)->first();
    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
    $cart_data   = json_decode($cookie_data, true);

    return view('pages.catalogo.detalhe-produto', compact('produto', 'empresa', 'grupos', 'cookie_data', 'cart_data'));
  }

  // função para calcular total de preços dos produtos no carrinho
  public function totalprodutoscarrinho()
  {
    $totalprodutos  = 0;
    $cookie_data    = stripslashes(Cookie::get('shopping_cart'));
    $cart_data      = json_decode($cookie_data, true);
    $teste = 0;
    if($cart_data != null){
      foreach ($cart_data as $data){
        if($data['item_quantity'] != 1){
          $totalprodutos = $this->totalprodutos += $data['item_price'] * $data['item_quantity'];
        }else {
          $totalprodutos = $this->totalprodutos += $data['item_price'];
        }
      }
    }

    return $totalprodutos;
  }

  // função para calcular total de adicionais dos produtos
  public function totaladicional($idempresa)
  {
    $totaladicional = 0;
    $cookie_data    = stripslashes(Cookie::get('shopping_cart'));
    $cart_data      = json_decode($cookie_data, true);
    $complementos   = Complemento::where('empresa_id', $idempresa)->get();

    if($cart_data){
      foreach ($cart_data as $data){
        if ($data['complem_produ'] != null){
          foreach ($data['complem_produ'] as $item){
            foreach ($complementos->where('id', $item) as $complemento){
              $totaladicional = $this->totaladicional += $complemento->preco;
            }
          }
        }
      }
    }

    return $totaladicional;
  }

  public function cart($slug)
  {
    $empresa        = $this->empresa->where('slug', $slug)->first();
    $grupos         = $this->grupos->where('empresa_id', $empresa->id)->get();
    $produtos       = $this->produtos->where('empresa_id', $empresa->id)->get();
    $complementos   = Complemento::where('empresa_id', $empresa->id)->get();
    $cookie_data    = stripslashes(Cookie::get('shopping_cart'));
    $cart_data      = json_decode($cookie_data, true);

    $totalprodutos  = $this->totalprodutoscarrinho();
    $totaladicional = $this->totaladicional($empresa->id);

    return view('pages.catalogo.cart', compact('produtos', 'empresa', 'grupos', 'cart_data', 'complementos', 'totalprodutos', 'totaladicional'));
  }

  public function checkout($slug)
  {
    $empresa        = $this->empresa->where('slug', $slug)->first();
    $grupos         = $this->grupos->where('empresa_id', $empresa->id)->get();
    $produtos       = $this->produtos->where('empresa_id', $empresa->id)->get();
    $config         = $this->config->where('empresa_id', $empresa->id)->first();
    $endereco       = EnderecoUsers::where('user_id', Auth::user()->id)->where('principal', 1)->first();
    $enderecos      = EnderecoUsers::where('user_id', Auth::user()->id)->get();
    $cookie_data    = stripslashes(Cookie::get('shopping_cart'));
    $cart_data      = json_decode($cookie_data, true);

    $totalprodutos  = $this->totalprodutoscarrinho();
    $totaladicional = $this->totaladicional($empresa->id);

    return view('pages.catalogo.checkout', compact('produtos', 'empresa', 'grupos', 'config', 'cart_data', 'endereco', 'enderecos', 'totalprodutos', 'totaladicional'));
  }

  public function profile($slug)
  {
    $empresa     = $this->empresa->where('slug', $slug)->first();
    $grupos      = $this->grupos->where('empresa_id', $empresa->id)->get();
    $produtos    = $this->produtos->where('empresa_id', $empresa->id)->get();
    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
    $cart_data   = json_decode($cookie_data, true);

    return view('pages.catalogo.account-profile', compact('produtos', 'empresa', 'grupos', 'cart_data'));
  }

  public function profileAddress($slug)
  {
    $empresa     = $this->empresa->where('slug', $slug)->first();
    $grupos      = $this->grupos->where('empresa_id', $empresa->id)->get();
    $produtos    = $this->produtos->where('empresa_id', $empresa->id)->get();
    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
    $cart_data   = json_decode($cookie_data, true);
    $address     = EnderecoUsers::where('user_id', Auth::user()->id)->get();

    return view('pages.catalogo.account-address', compact('produtos', 'empresa', 'grupos', 'cart_data', 'address'));
  }

  public function profilePedidos($slug)
  {
    $empresa     = $this->empresa->where('slug', $slug)->first();
    $grupos      = $this->grupos->where('empresa_id', $empresa->id)->get();
    $produtos    = $this->produtos->where('empresa_id', $empresa->id)->get();
    $address     = EnderecoUsers::where('user_id', Auth::user()->id)->get();
    $orders      = Cart::where('user_id', Auth::user()->id)->where('empresa_id', $empresa->id)->orderBy('created_at', 'desc')->get();

    return view('pages.catalogo.account-pedidos', compact('produtos', 'empresa', 'grupos', 'address', 'orders'));
  }

  public function PedidoDetail($slug, $id, $pedido)
  {
    $empresa     = $this->empresa->where('slug', $slug)->first();
    $grupos      = $this->grupos->where('empresa_id', $empresa->id)->get();
    $produtos    = $this->produtos->where('empresa_id', $empresa->id)->get();
    $address     = EnderecoUsers::where('user_id', Auth::user()->id)->get();
    $orders      = Cart::where('user_id', Auth::user()->id)->where('empresa_id', $empresa->id)->get();
    $order       = Cart::where('user_id', Auth::user()->id)->where('empresa_id', $empresa->id)->where('id', $pedido)->first();

    return view('pages.catalogo.order-detail', compact('produtos', 'empresa', 'grupos', 'address', 'orders', 'order'));
  }
}

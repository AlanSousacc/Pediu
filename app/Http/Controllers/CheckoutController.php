<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItems;
use App\Models\ComplementoItemCart;
use App\Models\Configuracao;
use App\Models\EnderecoUsers;
use App\Models\MeioameioItemCart;
use App\Models\Produto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
  public function processaPedido(Request $request)
  {
    $data = $request->except('_token');
    
    $user_id      = Auth::id();
    $user         = User::find($user_id);
    $cookie_data  = stripslashes(Cookie::get('shopping_cart'));
    $cart_data    = json_decode($cookie_data, true);

    if(count($cart_data) <= 0){
      $data = ['message' => 'O Pedido deve haver 1 ou mais itens!'];
      return response()->json($data, 500);
    }

    
    // ############ ENDEREÇO DE ENTREGA DO PEDIDO ############
    // caso o endereco de entrega seja o endereço padrão no cadastro pega o id do endereço.
    if($data['entrega'] == 'enderecocadastro'){
      $entrega = EnderecoUsers::where('user_id', $user_id)->where('empresa_id', $user->empresa_id)->where('principal', 1)->first()->id; //aqui eu obtenho o id do endereço de entrega padrão
    } else if($data['entrega'] == 'outroendereco'){
      if(isset($data['entrega_id']) && $data['entrega_id'] == 'novoendereco'){ //verifica se existe entrega id e se é um novo endereço.
        if($data['novo-endereco'] == "")
          return response()->json($data = ['message' => 'Para novos endereços o campo ENDEREÇO é obrigatório'], 500);
        if($data['novo-numero']  == "")
          return response()->json($data = ['message' => 'Para novos endereços o campo NÚMERO é obrigatório'], 500);
        if($data['novo-bairro']  == "")
          return response()->json($data = ['message' => 'Para novos endereços o campo BAIRRO é obrigatório'], 500);
        if($data['nova-cidade']  == "")
          return response()->json($data = ['message' => 'Para novos endereços o campo CIDADE é obrigatório'], 500);
        if($data['novo-telefone']  == "")
          return response()->json($data = ['message' => 'Para novos endereços o campo TELETONE é obrigatório'], 500);
        
        // aqui ele cadastra um novo endereço na conta do usuário
        $enduser             = new EnderecoUsers();
        $enduser->endereco   = $data['novo-endereco'];
        $enduser->numero     = $data['novo-numero'];
        $enduser->bairro     = $data['novo-bairro'];
        $enduser->cidade     = $data['nova-cidade'];
        $enduser->telefone   = $data['novo-telefone'];
        $enduser->principal  = 0;
        $enduser->user_id    = $user_id;
        $enduser->empresa_id = $user->empresa_id;

        $saved = $enduser->save();

        if (!$saved){
          $data = ['message' => 'Falha ao salvar endereço de entrega!'];
          return response()->json($data, 500);
        }

        $entrega = $enduser->id;
      } else if(!isset($data['entrega_id'])) { //se não existir um entrega_id ele redireciona p pagina anterior pois é necessário informar um endereço novo ou existente na listagem ou padrão
        $data = ['message' => 'Você deve escolher um endereço para entrega, ou cadastrar um novo!'];
          return response()->json($data, 500);
      } else {
        $entrega = EnderecoUsers::where('user_id', $user_id)->where('id', $data['entrega_id'])->first()->id; //obtendo o id do endereço de entrega da listagem
      }
      // fim da verificação de endereços e se necessário cadastro.
    }

    // ############ PEDIDO ############
    $numberorder                = rand(1111,9999);
    $cart                       = new Cart;
    $cart->user_id              = $user_id;
    $cart->empresa_id           = $user->empresa_id;
    $cart->formapagamento       = $data['formapagamento'];
    $cart->numberorder          = 'pediu'.$numberorder;
    $cart->statuspedido         = 0; //0 pendente | 1 aprovado | 2 em andamento | 3 saiu p entrega | 4 entregue | 5 cancelado
    $cart->observacaopedido     = $data['observacaopedido'];
    $cart->valortroco           = isset($data['trocopara']) ? $data['trocopara'] : '0.00';
    $cart->valorentrega         = Configuracao::where('empresa_id', $user->empresa_id)->first()->valorentrega;
    $cart->totalpedido          = $data['totalpedido'];
    $cart->subtotalpedido       = $data['subtotalpedido'];
    $cart->endereco_users_id    = $entrega;

    $cart->save();
    $last_cart_id  = $cart->id;
    $items_in_cart = $cart_data;

    foreach($items_in_cart as $itemdata){
      $produto = Produto::find($itemdata['item_id']);
      $preco   = $produto->precovenda;

      $cartitem = CartItems::create([
        'cart_id'       => $last_cart_id,
        'produto_id'    => $itemdata['item_id'],
        'user_id'       => $user_id,
        'empresa_id'    => $user->empresa_id,
        'preco'         => $preco,
        'observacaoitem'=> $itemdata['item_observacao'],
        'qtde'          => $itemdata['item_quantity'],
      ]);

      // aqui vai ser registrado cada complemento do item
      if($itemdata['complem_produ'] != null){
        foreach($itemdata['complem_produ'] as $compleitem){
          ComplementoItemCart::create([
            'cart_id'         => $last_cart_id,
            'produto_id'      => $itemdata['item_id'],
            'complemento_id'  => $compleitem,
            'empresa_id'      => $user->empresa_id,
            'cartitems_id'    => $cartitem->id,
          ]);
        }
      }

      // aqui vai ser registrado as pizzas meio a meio
      if($itemdata['meio_a_meio'] != null){
        foreach($itemdata['meio_a_meio'] as $meioameio){
          MeioameioItemCart::create([
            'cart_id'         => $last_cart_id,
            'produto_id'      => $meioameio,
            'empresa_id'      => $user->empresa_id,
            'cartitems_id'    => $cartitem->id,
          ]);
        }
      }

    }

    Cookie::queue(Cookie::forget('shopping_cart'));

    if($cart){
      $data = ['slug' => $user->empresa->slug, 'user' => $user_id];
      return response()->json($data, 200);
    }
  }
}

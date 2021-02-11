<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	// users
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

  // entregador
  Route::middleware(['auth', 'checkLicense', 'roleProfile'])->group(function () {
    Route::resource('entregador', 'EntregadorController');
  });

  // movimentacao
  Route::middleware(['auth', 'checkLicense', 'roleProfile'])->group(function () {
    Route::get('movimentacao/baixar/{id}', 'MovimentacaoController@baixarMovimentacao')->name('movimentacao.baixar');
    Route::get('movimentacao/receber/{id}', 'MovimentacaoController@receber')->name('movimentacao.receber');
  });

  // pedido
  Route::middleware(['auth', 'checkLicense', 'roleProfile'])->group(function () {
    Route::resource('pedido', 'PedidoController');
    Route::post('finalizar-pedido', 'PedidoController@store')->name('store.pedido');
    Route::get('pedido/detalhe/{id}', 'PedidoController@detalhePedido')->name('pedido.detalhe');
    Route::get('pedido/status/{id}', 'PedidoController@aplicarStatus')->name('pedido.status');
    Route::any('imprimir/pedido/{id}', 'PedidoController@print')->name('imprimir.pedido');
    Route::any('imprimir/pedido/venda/{id?}', 'PedidoController@imprimirPedido')->name('imprimir.pedido.venda');
    Route::any('resumo/periodo', 'PedidoController@resumoPeriodo')->name('pedidos.resumo.periodo');
  });

  // produto
  Route::middleware(['auth', 'checkLicense', 'roleProfile'])->group(function () {
    Route::resource('produto', 'ProdutoController');
    Route::get('preco-produto/{id?}', 'ProdutoController@returnPreco')->name('busca.precoproduto');
    Route::get('produto-pedido-json/{id?}', 'ProdutoController@returnProdutoPedido')->name('busca.produtopedido');
    Route::get('produto-pedido/{id?}', 'ProdutoController@buscaProdutoPedido')->name('busca.produto.pedido');
  });

  // endereco
  Route::middleware(['auth', 'checkLicense', 'roleProfile'])->group(function () {
    Route::resource('endereco', 'EnderecoController');
    Route::get('enderecos/{id?}', 'EnderecoController@returnEndereco')->name('busca.enderecos');
    Route::get('entrega/create/{id}', 'EnderecoController@createEndereco')->name('novo.endereco');
  });

  Route::middleware(['auth', 'checkLicense', 'roleProfile'])->group(function () {
    Route::get('/', 'ChartController@getWeekSales')->name('home');
  });

  //empresa
  Route::middleware(['auth', 'checkLicense', 'roleProfile', 'checkProfile'])->group(function () {
    Route::resource('empresa', 'EmpresaController');
    Route::get('cliente-id/{id?}', 'EmpresaController@returnCliente')->name('busca.clienteid');
    Route::any('empresa-licenca', 'EmpresaController@licencaEmpresa')->name('empresa.licenca');
  });

  // Licença
  Route::middleware(['auth', 'checkLicense', 'roleProfile'])->group(function () {
    Route::post('licenca/salvar', 'LicencaController@store')->name('licenca.store');
  });

  // contato
  Route::middleware(['auth', 'checkLicense', 'roleProfile'])->group(function () {
    Route::resource('contato', 'ContatoController');
    Route::get('contato/endereco/{id}', 'EnderecoController@listaEnderecoContato')->name('contato.endereco');
    Route::get('financeiro/contato/{id}', 'ContatoController@listaFinanceiroContato')->name('contato.financeiro');
  });

  // grupos
  Route::middleware(['auth', 'checkLicense', 'roleProfile'])->group(function () {
    Route::resource('grupo', 'GrupoController');
  });

  // configurações
  Route::middleware(['auth', 'checkLicense', 'roleProfile', 'checkProfile'])->group(function () {
    Route::resource('configuracao', 'ConfiguracaoController');
  });

  // acessos ao sistema
  Route::middleware(['roleProfile'])->group(function () {
    Route::get('unauthorized', 'AccessController@index')->name('unauthorized');
    Route::get('unauthorized-license', 'AccessController@verificaLicenca')->name('unauthorized-license');
  });

  Route::resource('address-user', 'EnderecoUsersController');
});

//Catalogo
Route::get('catalogo/{slug}/cart', 'CatalogoController@cart')->name('cart');
Route::get('catalogo/{slug}/checkout', 'CatalogoController@checkout')->name('checkout');
Route::get('catalogo/{slug}', 'CatalogoController@index')->name('catalogo');
Route::get('catalogo/{slug}/{grupo}', 'CatalogoController@grupo')->name('catalogoporgrupo');
Route::get('catalogo/{slug}/detalhe-produto/{id}', 'CatalogoController@detalheProduto')->name('catalogo-detalhe-produto');
Route::any('catalogo/{slug}/search', 'CatalogoController@search')->name('catalogoporpesquisa');
Route::get('catalogo/{empresa}', 'CatalogoController@getValorEntrega')->name('getValorEntrega');
Route::get('catalogo/perfil/{slug}/{id}', 'CatalogoController@profile')->name('profile');
Route::get('catalogo/endereco-perfil/{slug}/{id}', 'CatalogoController@profileAddress')->name('profile-address');
Route::get('catalogo/pedidos/{slug}/{id}', 'CatalogoController@profilePedidos')->name('profile-pedidos');
Route::get('catalogo/detalhe-pedidos/{slug}/{id}/{pedido}', 'CatalogoController@PedidoDetail')->name('profile-pedidos-detail');

// cart
Route::post('add-to-cart','CartController@addToCart');
Route::get('/load-cart-data','CartController@cartloadbyajax');
Route::post('update-to-cart','CartController@updatetocart');
Route::delete('delete-from-cart','CartController@deletefromcart');
Route::get('clear-cart','CartController@clearcart');
Route::post('processa-pedido', 'CheckoutController@processaPedido')->name('processa.pedido');

// Cliente
Route::resource('cliente', 'ClienteController');
Route::get('formulario-cadastro', 'ClienteController@novoCliente')->name('novo.cliente');

Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);

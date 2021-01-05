<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pedidos;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	// users
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	// entregador
	Route::resource('entregador', 'EntregadorController');

	// movimentacao
	Route::get('movimentacao/baixar/{id}', 'MovimentacaoController@baixarMovimentacao')->name('movimentacao.baixar');
	Route::get('movimentacao/receber/{id}', 'MovimentacaoController@receber')->name('movimentacao.receber');

	// pedido
	Route::resource('pedido', 'PedidoController');
	Route::post('finalizar-pedido', 'PedidoController@store')->name('store.pedido');
	Route::get('pedido/detalhe/{id}', 'PedidoController@detalhePedido')->name('pedido.detalhe');
	Route::get('pedido/status/{id}', 'PedidoController@aplicarStatus')->name('pedido.status');
	Route::any('imprimir/pedido/{id}', 'PedidoController@print')->name('imprimir.pedido');
	Route::any('imprimir/pedido/venda/{id?}', 'PedidoController@imprimirPedido')->name('imprimir.pedido.venda');
	Route::any('resumo/periodo', 'PedidoController@resumoPeriodo')->name('pedidos.resumo.periodo');

	// produto
	Route::resource('produto', 'ProdutoController');
	Route::get('preco-produto/{id?}', 'ProdutoController@returnPreco')->name('busca.precoproduto');
	Route::get('produto-pedido-json/{id?}', 'ProdutoController@returnProdutoPedido')->name('busca.produtopedido');
	Route::get('produto-pedido/{id?}', 'ProdutoController@buscaProdutoPedido')->name('busca.produto.pedido');

	// endereco
	Route::resource('endereco', 'EnderecoController');
	Route::get('enderecos/{id?}', 'EnderecoController@returnEndereco')->name('busca.enderecos');
	Route::get('entrega/create/{id}', 'EnderecoController@createEndereco')->name('novo.endereco');

	Route::get('/', 'ChartController@getWeekSales')->name('home');

  //empresa
  Route::resource('empresa', 'EmpresaController');
  Route::get('cliente-id/{id?}', 'EmpresaController@returnCliente')->name('busca.clienteid');

	// contato
	Route::resource('contato', 'ContatoController');
	Route::get('contato/endereco/{id}', 'EnderecoController@listaEnderecoContato')->name('contato.endereco');
	Route::get('financeiro/contato/{id}', 'ContatoController@listaFinanceiroContato')->name('contato.financeiro');
});

// Cliente
Route::resource('cliente', 'ClienteController');
Route::get('formulario-cadastro', 'ClienteController@novoCliente')->name('novo.cliente');

Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);

<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('site');

// Cliente
Route::resource('cliente', 'ClienteController');
Route::get('formulario-cadastro/{plano?}', 'ClienteController@novoCliente')->name('novo.cliente');
Route::get('verificar-slug/{slug?}', 'ClienteController@consultaSlug')->name('verificar.slug');

  Route::middleware(['auth', 'checkLicense', 'roleProfile'])->group(function () {
    // users
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    
    // pedido
    Route::resource('pedido', 'PedidoController');
    Route::post('finalizar-pedido', 'PedidoController@store')->name('store.pedido');
    Route::get('editar/pedido/{id?}', 'PedidoController@edit')->name('editar.pedido');
    Route::get('pedido/detalhe/{id?}', 'PedidoController@detalhePedido')->name('pedido.detalhe');
    Route::get('pedido/status/{id}', 'PedidoController@aplicarStatus')->name('pedido.status');
    Route::any('imprimir/pedido/{id}', 'PedidoController@print')->name('imprimir.pedido');
    Route::any('imprimir/pedido/venda/{id?}', 'PedidoController@imprimirPedido')->name('imprimir.pedido.venda');
    Route::post('processa-pedido-balcao', 'PedidoController@processaPedidoBalcao')->name('processa.pedido.balcao');
    Route::get('processa-status-pedido/{id?}', 'PedidoController@aplicarStatusBalcao')->name('pedido.status.balcao');
    Route::get('pedidos-balcao/status/{status}', 'PedidoController@filterstatus')->name('pedidosbalcao.filterstatus');
    Route::any('filtro-dia-balcao/{dia?}', 'PedidoController@filtrodia')->name('filtro.por.dia.balcao');
    Route::get('editar-pedidos/{id?}', 'PedidoController@editar')->name('edit.pedido');

    // dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('home');
    Route::get('/vendas-balcao-mensal', 'DashboardController@vendasBalcaoMensal')->name('vendas.balcao.mensal');
    Route::get('/vendas-loja-mensal', 'DashboardController@vendasLojaMensal')->name('vendas.loja.mensal');

    // entregador
    Route::resource('entregador', 'EntregadorController');

    // endereco
    Route::resource('endereco', 'EnderecoController');
    Route::get('enderecos/{id?}', 'EnderecoController@returnEndereco')->name('busca.enderecos');
    Route::get('entrega/create/{id}', 'EnderecoController@createEndereco')->name('novo.endereco');

    // produto
    Route::resource('produto', 'ProdutoController');
    Route::get('preco-produto/{id?}', 'ProdutoController@returnPreco')->name('busca.precoproduto');
    Route::get('produto-pedido-json/{id?}', 'ProdutoController@returnProdutoPedido')->name('busca.produtopedido');
    Route::get('produto-complementos-json/{id?}', 'ProdutoController@returnProdutoComplementos')->name('busca.complementosproduto');
    Route::get('produto-pedido/{id?}', 'ProdutoController@buscaProdutoPedido')->name('busca.produto.pedido');
    Route::get('search-item/{item?}', 'ProdutoController@searchItem')->name('search.item');
    Route::get('get-item-from-group/{id?}', 'ProdutoController@getItemFromGroup')->name('get.item.from.group');
    Route::get('get-items-pizza', 'ProdutoController@getItemsPizza')->name('get.item.pizza');

    // Licença
    Route::post('licenca/salvar', 'LicencaController@store')->name('licenca.store');

    // contato
    Route::resource('contato', 'ContatoController');
    Route::get('contato/endereco/{id}', 'EnderecoController@listaEnderecoContato')->name('contato.endereco');
    Route::get('lista-contatos-pedido', 'ContatoController@getContato')->name('lista.contatos.pedido');
    Route::get('endereco-cliente-pedido/{id?}', 'ContatoController@getEnderecoCliente')->name('get.endereco.cliente');

    // grupos
    Route::resource('grupo', 'GrupoController');

    // complementos
    Route::resource('complemento', 'ComplementoController');
    Route::get('preco-complemento/{id?}', 'ComplementoController@returnPreco')->name('busca.precocomplemento');
    Route::post('cadastrar-complemento', 'ComplementoController@cadastrar')->name('cadastrar.complemento');
    Route::get('complemento-produto/{id?}', 'ComplementoController@buscaComplementoProduto')->name('busca.complemento.produto');

    //empresa
    Route::middleware(['roleProfile', 'checkProfile'])->group(function () {
      Route::resource('empresa', 'EmpresaController');
      Route::get('cliente-id/{id?}', 'EmpresaController@returnCliente')->name('busca.clienteid');
      Route::any('empresa-licenca', 'EmpresaController@licencaEmpresa')->name('empresa.licenca');

      // configurações
      Route::resource('configuracao', 'ConfiguracaoController');
      Route::get('obtem-configuracao-epresa', 'ConfiguracaoController@getConfigEmpresa')->name('get.config.empresa');
    });

  });

  // acessos ao sistema
  Route::middleware(['roleProfile'])->group(function () {
    Route::get('unauthorized', 'AccessController@index')->name('unauthorized');
    Route::get('unauthorized-license', 'AccessController@verificaLicenca')->name('unauthorized-license');
  });

Route::group(['middleware' => 'auth'], function () {
  Route::resource('address-user', 'EnderecoUsersController');

  // pedidos loja
  Route::get('pedidos-loja', 'PedidosLojaController@index')->name('pedidosloja.index');
  Route::get('pedidos-loja-geral', 'PedidosLojaController@listagemPedidosLoja')->name('pedidosloja.all');
  Route::get('pedidos-loja/status/{status}', 'PedidosLojaController@filterstatus')->name('pedidosloja.filterstatus');
  Route::get('processa-status/{id?}', 'PedidosLojaController@aplicarStatus')->name('pedidoloja.status');
  Route::get('detalhe-pedido-loja/{id}', 'PedidosLojaController@detalhePedidoLoja')->name('detalhe.pedido.loja');
  Route::any('imprimir/pedidoloja/{id}', 'PedidosLojaController@printloja')->name('imprimir.pedidoloja');
  Route::any('filtro-dia/{dia?}', 'PedidosLojaController@filtrodia')->name('filtro.por.dia');

  //Catalogo
  Route::post('add-to-cart','CartController@addToCart');
  Route::get('precoitem/{slug?}/{produtoid?}/{tamanho?}', 'CatalogoController@precoitem')->name('busca.precoitem');
  Route::get('clear-cart','CartController@clearcart');
  Route::get('{slug}/cart', 'CatalogoController@cart')->name('cart');
  Route::get('{slug}/checkout', 'CatalogoController@checkout')->name('checkout');
  Route::get('perfil/{slug}/{id}', 'CatalogoController@profile')->name('profile');
  Route::get('endereco-perfil/{slug}/{id}', 'CatalogoController@profileAddress')->name('profile-address');
  Route::get('pedidos/{slug?}/{id?}', 'CatalogoController@profilePedidos')->name('profile.pedidos');
  Route::get('detalhe-pedidos/{slug}/{id}/{pedido}', 'CatalogoController@PedidoDetail')->name('profile-pedidos-detail');

  // cart
  Route::post('processa-pedido', 'CheckoutController@processaPedido')->name('processa.pedido');
  Route::post('update-to-cart','CartController@updatetocart');
  Route::delete('delete-from-cart','CartController@deletefromcart');
});

Route::get('{slug}', 'CatalogoController@index')->name('catalogo');
Route::get('{slug}/{grupo}', 'CatalogoController@grupo')->name('catalogoporgrupo');
Route::get('{slug}/detalhe-produto/{id}', 'CatalogoController@detalheProduto')->name('catalogo-detalhe-produto');
Route::any('{slug}/search', 'CatalogoController@search')->name('catalogoporpesquisa');
Route::get('{empresa}', 'CatalogoController@getValorEntrega')->name('getValorEntrega');

Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);

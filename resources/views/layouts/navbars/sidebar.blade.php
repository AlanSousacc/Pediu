@php $config = \App\Models\Configuracao::where('empresa_id', Auth::user()->empresa->id)->first(); @endphp

<div class="sidebar" data-color="{{$config->colorsidebar}}">
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-normal text-lg-center">
      <img src="{{ Auth::user()->empresa->logo == 'default.png' ? asset('assets/img/pediu.png') : url("storage/" .Auth::user()->empresa->logo) }}" alt="Ir ao Dashboard" title="Ir ao Dashboard" style="max-width: 100px; margin: 0 auto; display: inherit; border-radius: 100px">
      {{-- {{ Auth::user()->empresa->fantasia }} --}}
    </a>
    <div class="row w-100 m-0">
      <div class="col-md-12 text-center">
        <a href="{{route('catalogo', Auth::user()->empresa->slug)}}" target="_blank" class="text-white">Visitar Loja <i class="fa fa-store"></i></a>
      </div>
    </div>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      {{-- start pedidos --}}
      <li class="">
        <a data-toggle="collapse" href="#pedidos">
          <i class="now-ui-icons shopping_shop"></i>
          <p>
            {{ __("Pedidos") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'editarpedido' || $activePage == 'listagemPedidosLoja' || $activePage == 'detalhepedido' || $activePage == 'novopedido' || $activePage == 'listagemPedidos') show @endif" id="pedidos">
          <ul class="nav">
            <li class="">
              <a href="{{ route('pedidosloja.index') }}">
                <i class="fa fa-store-alt text-white"></i>
                <p> {{ __("Pedidos da Loja") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'listagemPedidosLoja') active @endif">
              <a href="{{ route('pedidosloja.all') }}">
                <i class="ionicons ion-ios-list-outline"></i>
                <p> {{ __("Listagem Pedidos Loja") }} </p>
              </a>
            </li>
            <hr class="my-3">
            @if ($config->controlepedidosbalcao == 1)
            <li class="@if ($activePage == 'novopedido') active @endif">
              <a href="{{ route('pedido.create') }}">
                <i class="fa fa-hard-hat"></i>
                <p> {{ __("Novo Pedido") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'listagemPedidos') active @endif">
              <a href="{{ route('pedido.index') }}">
                <i class="ionicons ion-ios-list-outline"></i>
                <p> {{ __("Listagem Pedidos Balcão") }} </p>
              </a>
            </li>
            @if ($activePage == 'detalhepedido')
            <li class="@if ($activePage == 'detalhepedido') active @endif">
              <a href="#">
                <i class="now-ui-icons files_paper"></i>
                <p> {{ __("Detalhe do Pedido") }} </p>
              </a>
            </li>
            @endif
            @if ($activePage == 'editarpedido')
            <li class="@if ($activePage == 'editarpedido') active @endif">
              <a href="#">
                <i class="ionicons ion-ios-compose-outline"></i>
                <p> {{ __("Editar Pedido") }} </p>
              </a>
            </li>
            @endif
            @endif
          </ul>
        </div>
      </li>
      {{-- end pedidos --}}

      {{-- start contatos --}}
      <li>
        <a data-toggle="collapse" href="#contatos">
          <i class="fa fa-user-friends"></i>
          <p>
            {{ __("Contatos") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'editarcontato' || $activePage == 'novocontato' || $activePage == 'listagemContato') show @endif" id="contatos">
          <ul class="nav">
            <li class="@if ($activePage == 'novocontato') active @endif">
              <a href="{{ route('contato.create') }}">
                <i class="now-ui-icons ui-1_simple-add"></i>
                <p> {{ __("Novo") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'listagemContato') active @endif">
              <a href="{{ route('contato.index') }}">
                <i class="ionicons ion-ios-list-outline"></i>
                <p> {{ __("Listagem Contatos") }} </p>
              </a>
            </li>
            @if ($activePage == 'editarcontato')
            <li class="@if ($activePage == 'editarcontato') active @endif">
              <a href="{{ route('contato.index') }}">
                <i class="ionicons ion-ios-compose-outline"></i>
                <p> {{ __("Editar Contato") }} </p>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </li>
      {{-- end contatos --}}

      {{-- Entregadores --}}
      @if($config->controlaentrega == 1)
      <li>
        <a data-toggle="collapse" href="#entregadores">
          <i class="now-ui-icons shopping_delivery-fast"></i>
          <p>
            {{ __("Entregadores") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'editarentregador' || $activePage == 'listagemEntregador' || $activePage == 'novoentregador') show @endif" id="entregadores">
          <ul class="nav">
            <li class="@if ($activePage == 'novoentregador') active @endif">
              <a href="{{ route('entregador.create') }}">
                <i class="now-ui-icons ui-1_simple-add"></i>
                <p> {{ __("Novo") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'listagemEntregador') active @endif">
              <a href="{{ route('entregador.index') }}">
                <i class="ionicons ion-ios-list-outline"></i>
                <p> {{ __("Listagem Entregador") }} </p>
              </a>
            </li>
            @if ($activePage == 'editarentregador')
            <li class="@if ($activePage == 'editarentregador') active @endif">
              <a href="{{ route('contato.index') }}">
                <i class="ionicons ion-ios-compose-outline"></i>
                <p> {{ __("Editar Entregador") }} </p>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </li>
      {{-- end entregadores --}}

      {{-- Endereço de entrega --}}
      <li>
        <a data-toggle="collapse" href="#localendereco">
          <i class="now-ui-icons location_pin"></i>
          <p>
            {{ __("Local de entrega") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'editarendereco' || $activePage == 'localendereco') show @endif" id="localendereco">
          <ul class="nav">
            <li class="@if ($activePage == 'localendereco') active @endif">
              <a href="{{ route('endereco.index') }}">
                <i class="ionicons ion-ios-list-outline"></i>
                <p> {{ __("Listagem Endereços") }} </p>
              </a>
            </li>
            @if ($activePage == 'editarendereco')
            <li class="@if ($activePage == 'editarendereco') active @endif">
              <a href="#">
                <i class="ionicons ion-ios-compose-outline"></i>
                <p> {{ __("Editar Endereço") }} </p>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </li>
      @endif
      {{-- end Endereço de entrega --}}

      {{-- Produtos --}}
      <li>
        <a data-toggle="collapse" href="#produtos">
          <i class="fa fa-box-open"></i>
          <p>
            {{ __("Produtos") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'novoComplemento' || $activePage == 'editarComplementos' || $activePage == 'listagemComplementos' || $activePage == 'listagemGrupos' || $activePage == 'editarproduto' || $activePage == 'listagemProdutos' || $activePage == 'novoproduto') show @endif" id="produtos">
          <ul class="nav">
            <li class="@if ($activePage == 'novoproduto') active @endif">
              <a href="{{ route('produto.create') }}">
                <i class="now-ui-icons ui-1_simple-add"></i>
                <p> {{ __("Novo") }} </p>
              </a>
            </li>
            @if ($activePage == 'editarproduto')
            <li class="@if ($activePage == 'editarproduto') active @endif">
              <a href="{{ route('complemento.index') }}">
                <i class="ionicons ion-ios-compose-outline"></i>
                <p> {{ __("Editar Produto") }} </p>
              </a>
            </li>
            @endif
            <li class="@if ($activePage == 'listagemProdutos') active @endif">
              <a href="{{ route('produto.index') }}">
                <i class="ionicons ion-ios-list-outline"></i>
                <p> {{ __("Listagem Produtos") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'listagemGrupos') active @endif">
              <a href="{{ route('grupo.index') }}">
                <i class="fa fa-tag"></i>
                <p> {{ __("Grupos") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'listagemComplementos') active @endif">
              <a href="{{ route('complemento.index') }}">
                <i class="fa fa-object-group"></i>
                <p> {{ __("Complementos") }} </p>
              </a>
            </li>
            @if ($activePage == 'novoComplemento')
            <li class="@if ($activePage == 'novoComplemento') active @endif">
              <a href="{{ route('complemento.create') }}">
                <i class="ionicons ion-ios-compose-outline"></i>
                <p> {{ __("Novo Complemento") }} </p>
              </a>
            </li>
            @endif
            @if ($activePage == 'editarComplementos')
            <li class="@if ($activePage == 'editarComplementos') active @endif">
              <a href="#">
                <i class="ionicons ion-ios-compose-outline"></i>
                <p> {{ __("Editar Complemento") }} </p>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </li>
      {{-- end produtos --}}

      {{-- usuários --}}
      <li>
        <a data-toggle="collapse" href="#usuarios">
          <i class="now-ui-icons users_single-02"></i>
          <p>
            {{ __("Usuários") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'editarusuario' || $activePage == 'listagemusuario' || $activePage == 'novousuario') show @endif" id="usuarios">
          <ul class="nav">
            <li class="@if ($activePage == 'novousuario') active @endif">
              <a href="{{ route('register') }}">
                <i class="now-ui-icons ui-1_simple-add"></i>
                <p> {{ __("Novo") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'listagemusuario') active @endif">
              <a href="{{ route('user.index') }}">
                <i class="ionicons ion-ios-list-outline"></i>
                <p> {{ __("Listagem Usuários") }} </p>
              </a>
            </li>
            @if ($activePage == 'editarusuario')
            <li class="@if ($activePage == 'editarusuario') active @endif">
              <a href="#">
                <i class="ionicons ion-ios-list-outline"></i>
                <p> {{ __("Editar Usuário") }} </p>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </li>
      {{-- end usuários --}}

      {{-- Administrativo --}}
      @if ((Auth::user()->isAdmin == 1) && (Auth::user()->profile == 'Administrador'))
      <li>
        <a data-toggle="collapse" href="#empresa">
          <i class="fa fa-user-shield"></i>
          <p>
            {{ __("Administrativo") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'editarempresa' || $activePage == 'listagemempresa' || $activePage == 'novaempresa') show @endif" id="empresa">
          <ul class="nav">
            <li class="@if ($activePage == 'novaempresa') active @endif">
              <a href="{{ route('empresa.create') }}">
                <i class="now-ui-icons ui-1_simple-add"></i>
                <p> {{ __("Nova Empresa") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'listagemempresa') active @endif">
              <a href="{{ route('empresa.index') }}">
                <i class="ionicons ion-ios-list-outline"></i>
                <p> {{ __("Listagem Empresa") }} </p>
              </a>
            </li>
            @if ($activePage == 'editarempresa')
            <li class="@if ($activePage == 'editarempresa') active @endif">
              <a href="#">
                <i class="ionicons ion-ios-list-outline"></i>
                <p> {{ __("Editar Empresa") }} </p>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </li>
      {{-- end Administrativo --}}
      @endif

      {{-- configuração --}}
      @if (Auth::user()->profile == 'Administrador')
      <li>
        <a data-toggle="collapse" href="#configuracoes">
          <i class="fa fa-cog"></i>
          <p>
            {{ __("Configurações") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'configuracaogeral') show @endif" id="configuracoes">
          <ul class="nav">
            <li class="@if ($activePage == 'configuracaogeral') active @endif">
              <a href="{{route('configuracao.create')}}">
                <i class="fa fa-users-cog"></i>
                <p> {{ __("Configurações Gerais") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      @endif
      {{-- end configuração --}}
    </ul>
  </div>
</div>

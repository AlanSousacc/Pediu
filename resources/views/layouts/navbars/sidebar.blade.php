<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-mini">
      {{ __('SF') }}
    </a>
    <a href="{{ route('home') }}" class="simple-text logo-normal">
      {{ __('Suzi Fiacadori') }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      {{-- start pedidos --}}
      <li class="active">
        <a data-toggle="collapse" href="#pedidos">
          <i class="now-ui-icons shopping_shop" style="color: #f96332;"></i>
          <p style="color: #f96332;">
            {{ __("Pedidos") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'editarpedido' || $activePage == 'detalhepedido' || $activePage == 'novopedido' || $activePage == 'listagemPedidos') show @endif" id="pedidos">
          <ul class="nav">
            <li class="@if ($activePage == 'novopedido') active @endif">
              <a href="{{ route('pedido.create') }}">
                <i class="now-ui-icons shopping_bag-16"></i>
                <p> {{ __("Novo Pedido") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'listagemPedidos') active @endif">
              <a href="{{ route('pedido.index') }}">
                <i class="ionicons ion-ios-list-outline"></i>
                <p> {{ __("Listagem") }} </p>
              </a>
            </li>
            @if ($activePage == 'detalhepedido')
            <li class="@if ($activePage == 'detalhepedido') active @endif">
              <a href="{{ route('pedido.detalhe', $item->id) }}">
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
                <p> {{ __("Listagem") }} </p>
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
                <p> {{ __("Listagem") }} </p>
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
                <p> {{ __("Listagem") }} </p>
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
        <div class="collapse @if ($activePage == 'editarproduto' || $activePage == 'listagemProdutos' || $activePage == 'novoproduto') show @endif" id="produtos">
          <ul class="nav">
            <li class="@if ($activePage == 'novoproduto') active @endif">
              <a href="{{ route('produto.create') }}">
                <i class="now-ui-icons ui-1_simple-add"></i>
                <p> {{ __("Novo") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'listagemProdutos') active @endif">
              <a href="{{ route('produto.index') }}">
                <i class="ionicons ion-ios-list-outline"></i>
                <p> {{ __("Listagem") }} </p>
              </a>
            </li>
            @if ($activePage == 'editarproduto')
            <li class="@if ($activePage == 'editarproduto') active @endif">
              <a href="{{ route('produto.index') }}">
                <i class="ionicons ion-ios-compose-outline"></i>
                <p> {{ __("Editar Produto") }} </p>
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
                <p> {{ __("Listagem") }} </p>
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
    </ul>
  </div>
</div>

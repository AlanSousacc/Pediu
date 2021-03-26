@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
@extends('pages.catalogo.layouts.modal-login-register')
{{-- header --}}
@extends('layouts.messages.message-loja')
<div class="page-title-overlap bg-dark pt-4">
  <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
    <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
      <h1 class="h3 text-light mb-0">Listagem de Pedidos</h1>
    </div>
  </div>
</div>
{{-- end header --}}
<section class="container tab-content py-4 py-sm-5">
  <div class="row">
    {{-- content --}}
    <div class="container pb-5 mb-2 mb-md-3">
      <div class="row">
        <!-- Sidebar-->
        <aside class="col-lg-3 pt-4 pt-lg-0">
          <div class="cz-sidebar-static rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0">
            <div class="px-4 mb-4">
              <div class="media align-items-center">
                <div class="media-body pl-3">
                  <h3 class="font-size-base mb-0">{{auth()->user()->name}}</h3><span class="text-accent font-size-sm">{{auth()->user()->email}}</span>
                </div>
              </div>
            </div>
            <div class="bg-secondary px-4 py-3">
              <h3 class="font-size-sm mb-0 text-muted">Dashboard</h3>
            </div>
            <ul class="list-unstyled mb-0">
              <li class="border-bottom mb-0">
                <a class="nav-link-style d-flex align-items-center px-4 py-3 active" href="{{route('profile-pedidos', array($empresa->slug, auth()->user()->id))}}">
                  <i class="fas fa-shopping-bag opacity-60 mr-2"></i>  Pedidos<span class="font-size-sm text-muted ml-auto">{{isset($pedidos) ? count($pedidos) : 0}}</span>
                </a>
              </li>
            </ul>
            <div class="bg-secondary px-4 py-3">
              <h3 class="font-size-sm mb-0 text-muted">Account settings</h3>
            </div>
            <ul class="list-unstyled mb-0">
              <li class="border-bottom mb-0">
                <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{route('profile', array($empresa->slug, auth()->user()->id))}}">
                  <i class="fas fa-info-circle opacity-60 mr-2"></i>Informações do Perfil</a>
                </li>
                <li class="border-bottom mb-0">
                  <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{route('profile-address', array($empresa->slug, auth()->user()->id))}}">
                    <i class="fas fa-map-marked-alt opacity-60 mr-2"></i>Endereço</a>
                  </li>
                  <li class="border-top mb-0">
                    <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                      <i class="fa fa-sign-in-alt opacity-60 mr-2"></i>Sair
                      <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                    </a>
                  </li>
                </ul>
              </div>
            </aside>
            <!-- Content  -->
            <section class="col-lg-9">
              <!-- Toolbar-->
              <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
              </div>
              <div class="table-responsive fs-md mb-4">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Pedido #</th>
                      <th>Data Realizada</th>
                      <th>Status</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (isset($orders))
                    @foreach ($orders as $item)
                    <tr>
                      <td class="py-3"><a class="nav-link-style fw-medium fs-sm" href="{{route('profile-pedidos-detail', array($empresa->slug, auth()->user()->id, $item->id))}}" data-bs-toggle="modal">{{$item->numberorder}}</a></td>
                      <td class="py-3">{{$item->created_at->format('d/m/Y H:i')}}</td>
                      <td class="py-3">
                        @if ($item->statuspedido == 0)
                        <span class="text-light bg-warning p-1 rounded">Pendente</span>
                        @elseif($item->statuspedido == 1)
                        <span class="text-light bg-info p-1 rounded">Aprovado</span>
                        @elseif($item->statuspedido == 2)
                        <span class="text-light bg-dark p-1 rounded">Preparando</span>
                        @elseif($item->statuspedido == 3)
                        <span class="text-light bg-primary p-1 rounded">Saiu para Entrega</span>
                        @elseif($item->statuspedido == 4)
                        <span class="text-light bg-success p-1 rounded">Entregue</span>
                        @elseif($item->statuspedido == 5)
                        <span class="text-light bg-danger p-1 rounded">Cancelado</span>
                        @endif
                      </td>
                      <td class="py-3"><small>R$</small> {{number_format($item->totalpedido, 2, ',', '.')}}</td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </section>
          </div>
        </div>
        {{-- endcontent --}}
      </div>
    </section>
    {{-- modal create address--}}
    @include('users.address.modalCreateAddress')

    @push('scripts')
    <script src='{{asset('js/usuarios/usuarios.js')}}'></script>

    <script type="text/javascript">
      $(document).ready(function () {
        $('#telefone').mask('(00) 00000-0000');
      });
    </script>
    @endpush
    @endsection


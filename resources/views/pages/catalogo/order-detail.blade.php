@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
@extends('pages.catalogo.layouts.modal-login-register')
{{-- header --}}
@extends('layouts.messages.message-loja')
<div class="page-title-overlap bg-dark pt-4">
  <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
    <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
      <h1 class="h3 text-light mb-0">Pedidos - Detalhes do pedido: <span class="font-weight-light">{{($order->numberorder)}}</span></h1>
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
                  <i class="fas fa-shopping-bag opacity-60 mr-2"></i>  Pedidos<span class="font-size-sm text-muted ml-auto">{{isset($orders) ? count($orders) : 0}}</span>
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
              <div class="modal-header">
                <h5 class="modal-title"><small>#</small> {{$order->numberorder}}</h5>
                <div class="fs-lg text-accent pt-2">{{$order->created_at->format('d/m/Y H:i')}}</div>
              </div>
              {{-- @dd($order->complementositemcart) --}}
              @foreach ($order->orderitems as $item)
              <div class="d-sm-flex justify-content-between mb-4 pb-3 pb-sm-2 border-bottom">
                <div class="d-sm-flex text-center text-sm-start">
                  <a class="d-inline-block flex-shrink-0 mr-3" href="{{route('catalogo-detalhe-produto', array($empresa->slug, $item->produtos->id))}}" style="width: 10rem;">
                    <img src="{{ $item->produtos->foto != 'default.png' ? url("storage/".$item->produtos->foto) : url("storage/img/logos/default.png")}}" alt="{{$item->produtos->descricao}}">
                  </a>
                  <div class="ps-sm-4 pt-2 text-left">
                    <h3 class="product-title fs-base mb-2">
                      <a href="{{route('catalogo-detalhe-produto', array($empresa->slug, $item->produtos->id))}}">{{$item->produtos->descricao}}</a>
                    </h3>
                    {{-- <div class="fs-sm"><span class="text-muted me-2 text-left">Composição: </span>{{$item->produtos->composicao}}</div> --}}
                    <div class="font-size-sm">
                      @php $totaladicional = 0 @endphp
                      @if (count($order->complementositemcart) > 0)
                      <span class="text-muted me-2">Adicionais:</span> <br>
                      @foreach ($order->complementositemcart as $adicionais)
                        @if($adicionais->complitemcartid == $item->complitemid)
                        @php $totaladicional += $adicionais->complemento->preco @endphp
                        <span class="bg-dark text-white p-1 rounded"> {{$adicionais->complemento->descricao}}</span>
                        @endif
                        @endforeach
                      @endif
                    </div>
                  </div>
                </div>
                <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                  <div class="text-muted mb-2">Quantidade: </div>{{$item->qtde}}
                </div>
                <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                  <div class="text-muted mb-2">Subtotal: </div><small>R$</small> {{number_format(($item->qtde * $item->preco) + $totaladicional, 2, ',', '.')}}
                </div>
              </div>
              @endforeach
              <div class="modal-footer flex-wrap justify-content-between bg-secondary fs-md">
                <div class="px-2 py-1"><span class="text-muted">Subtotal:&nbsp;</span><small>R$ </small><span>{{number_format(($item->qtde * $item->preco) + $totaladicional, 2, ',', '.')}}</span></div>
                <div class="px-2 py-1"><span class="text-muted">Entrega:&nbsp;</span><small>R$ </small><span>{{number_format($order->valorentrega, 2, ',', '.')}}</span></div>
                <div class="px-2 py-1"><span class="text-muted">Total:&nbsp;</span><small>R$ </small><span>{{number_format(($item->qtde * $item->preco) + $totaladicional + $order->valorentrega, 2, ',', '.')}}</span></div>
                <div class="px-2 py-1"><span class="text-muted">Forma de Pagamento:&nbsp;</span><small></small><span>{{$order->formapagamento}}</span></div>
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

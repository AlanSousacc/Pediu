<!DOCTYPE html>
<html lang="PT-br">
<head>
  <meta charset="utf-8">
  <title>{{strtoupper($empresa->slug)}} | Food Delivery
  </title>
  <!-- SEO Meta Tags-->
  <meta name="description" content="Cartzilla - Bootstrap E-commerce Template">
  <meta name="keywords" content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap 4, html5, css3, jquery, js, gallery, slider, touch, creative, clean">
  <meta name="author" content="Createx Studio">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Viewport-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon and Touch Icons-->
  <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
  <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
  <link href='{{asset('assets/css/simplebar.min.css')}}' rel='stylesheet' />
  <link href='{{asset('assets/css/tiny-slider.css')}}' rel='stylesheet' />
  <link href='{{asset('assets/css/theme.min.css')}}' rel='stylesheet' />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link href='{{asset('assets/css/style.css')}}' rel='stylesheet' />
</head>
<!-- Body-->
<body class="toolbar-enabled">
    <header class="navbar d-block navbar-sticky navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <div class="d-block d-md-none">
          <a href="{{!auth()->check() ? route('catalogo', $empresa->slug) : route('catalogo', auth()->user()->empresa->slug)}}">
            <img width="60px" src="{{$empresa->logo == 'default.png' ? asset('assets/img/pediu.png') : url("storage/" .$empresa->logo)}}" alt="{{ $empresa->razao}}"/>
          </a>
        </div>
        <div class="navbar-toolbar d-flex align-items-center order-lg-3 mt-3 pt-2">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <i class="fa fa-bars"></i>
          </button>

          <a class="navbar-tool d-none d-lg-flex" href="#searchBox" type="submit" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="searchBox">
            <span class="navbar-tool-tooltip">Search</span>
            <div class="navbar-tool-icon-box">
              <i class="fa fa-search"></i>
            </div>
          </a>
        </form>
        @if (!auth()->check())
        <a class="navbar-tool ml-2" href="#signin-modal" data-toggle="modal">
          <span class="navbar-tool-tooltip">Account</span>
          <div class="navbar-tool-icon-box d-none d-md-block">
            <i class="far fa-user"></i>
          </div>
        </a>
        @else
        <a class="navbar-tool ml-2" href="{{ route('profile', array($empresa->slug, auth()->user()->id)) }}">
          <div class="navbar-tool-icon-box d-none d-md-block">
            <i class="fa fa-user-circle"></i>
          </div>
          <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </a>
        @endif

        <div class="navbar-tool dropdown ml-3 ">
          <a class="navbar-tool-icon-box dropdown-toggle d-none d-md-block" href="{{route('cart', $empresa->slug)}}">
            @if(isset($cart_data) && auth()->check())<!-- só vai aparecer a quantidade de itens caso a sessão existir e se o usuário estiver logado -->
            @php $total = 0 @endphp
            @foreach($cart_data as $data)
            @php $total += $data["item_quantity"] @endphp
            @if ($data['user_id'] == auth()->user()->id)<!-- só vai listar os produtos da sessão se o id da sessao user id for igual o id do usuário logado-->
            <span class="navbar-tool-label pt-1">
              <span class="badge badge-pill red"> {{$total}} </span>
            </span>
            @endif
            @endforeach
            @endif
            <i class="fa fa-shopping-cart"></i>
          </a>
          <!-- Cart dropdown-->
          <div class="dropdown-menu dropdown-menu-right" style="width: 20rem;">
            <div class="widget widget-cart px-3 pt-2 pb-3">
              <div style="height: 15rem;" data-simplebar="init" data-simplebar-auto-hide="false">
                <div class="simplebar-wrapper" style="margin: 0px -16px 0px 0px;">
                  <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                  </div>
                  @php $total = 0 @endphp
                  <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                      <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px 16px 0px 0px;">
                          @if(isset($cart_data) && auth()->check())
                          @if(Cookie::get('shopping_cart'))
                          @php $total = "0" @endphp
                          @foreach($cart_data as $data)
                          @if ($data['user_id'] == auth()->user()->id)
                          <div class="widget-cart-item pb-2 border-bottom cartpage">
                            <input type="hidden" class="product_id" value="{{ $data['item_id'] }}" >
                            <button class="close text-danger delete_cart_data" type="button" aria-label="Remove">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="media align-items-center">
                              <a class="d-block mr-2" href="{{route('catalogo-detalhe-produto',array($empresa->slug, $data['item_id']))}}">
                                <img width="64" src="{{ url("storage/".$data['item_image'])}}" alt="Pizza">
                              </a>
                              <div class="media-body">
                                <h6 class="widget-product-title">
                                  <a href="{{route('catalogo-detalhe-produto',array($empresa->slug, $data['item_id']))}}">{{$data['item_name']}}</a>
                                </h6>
                                <div class="widget-product-meta">
                                  <span class="text-accent mr-2">R$ {{number_format($data['item_quantity'] * $data['item_price'], 2, ',', '.')}}</small>
                                  </span>
                                  <span class="text-muted">x {{$data['item_quantity']}}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          @php $total = $total + ($data["item_quantity"] * $data["item_price"]) @endphp
                          @endif
                          @endforeach
                          @endif
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="simplebar-placeholder" style="width: 0px; height: 0px;">
                  </div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                  <div class="simplebar-scrollbar simplebar-visible" style="width: 0px; display: none;">
                  </div>
                </div>
                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                  <div class="simplebar-scrollbar simplebar-visible" style="height: 0px; display: none;">
                  </div>
                </div>
              </div>
              <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                <div class="font-size-sm mr-2 py-2">
                  <span class="text-muted">Total:</span>
                  <span class="text-accent font-size-base ml-1"><small>R$</small> {{isset($total) ? number_format($total, 2, ',', '.') : '0,00'}}</span>
                </div>
                <a class="btn btn-outline-secondary btn-sm" href="{{route('cart', $empresa->slug)}}">Mostrar Carrinho <i class="fa fa-angle-right"></i></a>
              </div>
              <a class="btn btn-primary btn-sm btn-block" href="{{route('checkout', $empresa->slug)}}">
                <i class="fa fa-credit-card"></i> Checkout</a>
              </div>
            </div>
          </div>

        </div>
        <div class="collapse navbar-collapse mr-auto order-lg-2" id="navbarCollapse">
          <!-- Search (mobile)-->
          <form action="{{route('catalogoporpesquisa', $empresa->slug)}}" autocomplete="off" method="post">
            @csrf
            <div class="d-lg-none py-3">
              <div class="input-group-overlay">
                <div class="row">
                  <div class="col-sx-12 mr-3 ml-4">
                    <input class="form-control prepended-form-control" name="searchfield" type="text" placeholder="O que está buscando?">
                  </div>
                  <div class="col-xs-4 mt-1">
                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </header>
      <!-- Search collapse-->
      <form action="{{route('catalogoporpesquisa', $empresa->slug)}}" autocomplete="off" method="post" style="margin: 0 auto">
        @csrf
        <div class="search-box collapse" id="searchBox">
          <div class="container py-2">
            <div class="input-group-overlay">
              <div class="input-group-prepend-overlay">
                <span class="input-group-text">
                  <i class="fa fa-search"></i>
                </span>
              </div>
              <div class="row">
                <div class="col-md-11">
                  <input class="form-control prepended-form-control" name="searchfield" type="text" placeholder="O que está buscando?">
                </div>
                <div class="col-md-1">
                  <button class="btn btn-primary">pesquisar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </header>
    <section class="bg-darker bg-size-cover bg-position-center py-5" style="background-image: url({{asset('assets/img/pt-bg.jpg')}});">
      <div class="container py-md-4 text-center">
        <a href="{{!auth()->check() ? route('catalogo', $empresa->slug) : route('catalogo', auth()->user()->empresa->slug)}}" class="d-none d-md-block">
          <img width="142" src="{{$empresa->logo == 'default.png' ? asset('assets/img/pediu.png') : url("storage/" .$empresa->logo)}}" alt="{{ $empresa->razao}}"/>
        </a>
        <h4 href="{{!auth()->check() ? route('catalogo', $empresa->slug) : route('catalogo', auth()->user()->empresa->slug)}}" class="d-block d-md-none pb-5 pt-2 text-white" >
          {{Str::upper($empresa->slug)}}
        </h4>
      </div>
    </section>
    <!-- Page navigation-->
    <nav class="container mt-n5">
      <div class="media align-items-center bg-white rounded-lg box-shadow-lg py-2 pl-sm-2 pr-lg-2">

        <div class="media-body text-right" style="display: contents">
          <!-- For desktop-->
          <ul class="nav" style="display: inline-block; overflow: auto; overflow-y: hidden; max-width: 100%; margin: 0 0 1em; white-space: nowrap;">
            @foreach ($empresa->grupos as $item)
            <li class="nav-item text-center" style="display: inline-block; vertical-align: top;">
              <a class="nav-link active" href="{{ route('catalogoporgrupo', array($empresa->slug, $item->descricao)) }}">
              <img src="{{url("storage/" .$item->image)}}" alt="{{ $empresa->razao}}" style="height: 150px; width: 150px; border-radius: 100px; padding: 5px;"/> <br>
              {{$item->descricao}}
              </a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </nav>


    @yield('content')

    <!-- Footer-->
    <footer class="bg-darker pt-2">
      <div class="container pt-2">
        <div class="text-center pb-1">
          <p>© Todos os direitos reservados. ACPTI</p>
        </div>
      </div>
    </footer>
    <!-- Toolbar for handheld devices-->
    <div class="cz-handheld-toolbar">
      <div class="d-table table-fixed w-100">
        {{-- {{auth()->check() ? route('profile', auth()->user()->id) : '#signin-modal'}} --}}
        <a class="d-table-cell cz-handheld-toolbar-item py-2" href="{{auth()->check() ? route('profile', array($empresa->slug, auth()->user()->id)) : '#signin-modal'}}" {{!auth()->check() ? 'data-toggle=modal' : ''}}>
          <span class="cz-handheld-toolbar-icon">
            <i class="fa fa-user-circle"></i></span>
            <span class="cz-handheld-toolbar-label">Minha Conta</span>
          </a>
          <a class="d-table-cell cz-handheld-toolbar-item" href="{{route('catalogo', $empresa->slug)}}">
            <span class="cz-handheld-toolbar-icon">
              <i class="fa fa-home"></i></span>
              <span class="cz-handheld-toolbar-label">Home</span>
            </a>
            <a class="d-table-cell cz-handheld-toolbar-item" href="{{route('cart', $empresa->slug)}}">
              <span class="cz-handheld-toolbar-icon carrinho">
                <i class="fa fa-shopping-cart"></i>
              </span>
              @if(isset($cart_data) && auth()->check())
              @if(Cookie::get('shopping_cart'))
              @php $total = "0" @endphp
              @foreach($cart_data as $data)
              @if ($data['user_id'] == auth()->user()->id)
              @php $total += ($data["item_quantity"] * $data["item_price"]) @endphp
              @endif
              @endforeach
              <span class="cz-handheld-toolbar-label">R$ {{isset($total) ? number_format($total, 2, ',', '.') : '0,00'}}</span>
              @endif
              @else
              <span class="cz-handheld-toolbar-label">R$ 0,00</span>
              @endif
            </a>
          </div>
        </div>
        <script src="{{ asset('js/jquery.js')}}"></script>
        <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
        <script src='{{asset('js/catalogo/jquery.slim.min.js')}}'></script>
        {{-- <script src='{{asset('js/catalogo/bootstrap.bundle.min.js')}}'></script> --}}
        <script src='{{asset('js/catalogo/bs-custom-file-input.min.js')}}'></script>
        <script src='{{asset('js/catalogo/simplebar.min.js')}}'></script>
        <script src='{{asset('js/catalogo/tiny-slider.js')}}'></script>
        <script src='{{asset('js/catalogo/smooth-scroll.polyfills.min.js')}}'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script src='{{asset('js/catalogo/theme.min.js')}}'></script>
        <script src='{{asset('js/catalogo/scripts-custom.js')}}'></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>

        <script type="text/javascript">
          $(document).ready(function () {
            $('#su-telefone').mask('(00) 00000-0000');
          });

          @error ('email')
            $('#signin-modal').modal('show');
          @enderror
        </script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>

        @stack('scripts')
      </body>

      </html>

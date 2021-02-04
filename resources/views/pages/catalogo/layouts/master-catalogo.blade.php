<!DOCTYPE html>
<html lang="PT-br">
<head>
  <meta charset="utf-8">
  <title>Cartzilla | Food Delivery - Category
  </title>
  <!-- SEO Meta Tags-->
  <meta name="description" content="Cartzilla - Bootstrap E-commerce Template">
  <meta name="keywords" content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap 4, html5, css3, jquery, js, gallery, slider, touch, creative, clean">
  <meta name="author" content="Createx Studio">
  <!-- Viewport-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon and Touch Icons-->
  <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
  <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
  <link href='{{asset('assets/css/simplebar.min.css')}}' rel='stylesheet' />
  <link href='{{asset('assets/css/tiny-slider.css')}}' rel='stylesheet' />
  <link href='{{asset('assets/css/theme.min.css')}}' rel='stylesheet' />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<!-- Body-->
<body class="toolbar-enabled">
  {{-- <!-- Google Tag Manager (noscript)-->
    <noscript>
      <iframe src="//www.googletagmanager.com/ns.html?id=GTM-WKV3GT5" height="0" width="0" style="display: none; visibility: hidden;"></iframe>
    </noscript> --}}
    <header class="navbar d-block navbar-sticky navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <div class="navbar-toolbar d-flex align-items-center order-lg-3 mt-3 pt-2">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
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
          <div class="navbar-tool-icon-box">
            <i class="far fa-user"></i>
          </div>
        </a>
        @else
        <a class="navbar-tool ml-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
          <div class="navbar-tool-icon-box">
            <i class="fa fa-sign-out-alt"></i>
          </div>
          <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </a>
        @endif

        <div class="navbar-tool {{session('cart') != null && auth()->check() ? 'dropdown' : ''}}  ml-3">
          <a class="navbar-tool-icon-box dropdown-toggle" href="{{$empresa->slug. '/cart'}}">
            @if (session('cart') != null && auth()->check())<!-- só vai aparecer a quantidade de itens caso a sessão existir e se o usuário estiver logado -->
            @php $qtdeitem = 0; @endphp
            @foreach(session('cart') as $id=>$details)
            @php $details['user'] == auth()->user()->id ? $qtdeitem ++ : '' @endphp
            @if ($details['user'] == auth()->user()->id)<!-- só vai listar os produtos da sessão se o id da sessao user id for igual o id do usuário logado-->
            <span class="navbar-tool-label">
              {{$qtdeitem}}
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
                          @if(session('cart') != null && auth()->check())
                          @foreach(session('cart') as $id=>$details)
                          @if ($details['user'] == auth()->user()->id)
                          @php $total += $details['precovenda'] * $details['quantity'] @endphp
                          <div class="widget-cart-item pb-2 border-bottom">
                            <button class="close text-danger remove-from-cart" data-id="{{ $id }}" type="button" aria-label="Remove">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="media align-items-center">
                              <a class="d-block mr-2" href="#">
                                <img width="64" src="{{ url("storage/".$details['foto'])}}" alt="Pizza">
                              </a>
                              <div class="media-body">
                                <h6 class="widget-product-title">
                                  <a href="#">{{$details['descricao']}}</a>
                                </h6>
                                <div class="widget-product-meta">
                                  <span class="text-accent mr-2">R$ {{number_format($total, 2, ',', '.')}}</small>
                                  </span>
                                  <span class="text-muted">x {{$details['quantity']}}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endif
                          @endforeach
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
                  <span class="text-accent font-size-base ml-1">R$ {{number_format($total, 2, ',', '.')}}</span>
                </div>
                <a class="btn btn-outline-secondary btn-sm" href="cart">Expand cart <i class="fa fa-angle-right"></i></a>
              </div>
              <a class="btn btn-primary btn-sm btn-block" href="checkout">
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
                  <div class="col-xs-4">
                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
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
      <div class="container py-md-4">
        <h1 class="text-light text-center text-lg-left py-3">{{$empresa->fantasia}}</h1>
      </div>
    </section>
    <!-- Page navigation-->
    <nav class="container mt-n5">
      <div class="media align-items-center bg-white rounded-lg box-shadow-lg py-2 pl-sm-2 pr-4 pr-lg-2">
        <a href="{{!auth()->check() ? route('catalogo', $empresa->slug) : route('catalogo', auth()->user()->empresa->slug)}}">
          <img width="142" src="{{$empresa->logo == 'default.png' ? asset('assets/img/pediu.png') : url("storage/" .$empresa->logo)}}" alt="{{ $empresa->razao}}"/>
        </a>
        <div class="media-body text-right">
          <!-- For desktop-->
          <ul class="nav nav-tabs d-none d-lg-flex border-0 mb-0">
            @foreach ($grupos as $item)
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('catalogoporgrupo', array($empresa->slug, $item->id)) }}">{{$item->descricao}}</a>
            </li>
            @endforeach
          </ul>
          <!-- For mobile-->
          <div class="btn-group dropdown d-lg-none ml-auto">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bars"></i> Categorias</button>
            <div class="dropdown-menu dropdown-menu-right">
              @foreach ($grupos as $item)
              <a class="dropdown-item font-size-base active" href="#">{{$item->descricao}}</a>
              @endforeach
            </div>
          </div>
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
        <a class="d-table-cell cz-handheld-toolbar-item" href="#signin-modal" data-toggle="modal">
          <span class="cz-handheld-toolbar-icon"><i class="czi-user"></i></span>
          <span class="cz-handheld-toolbar-label">Account</span>
        </a>
        <a class="d-table-cell cz-handheld-toolbar-item" href="#navbarCollapse" data-toggle="collapse" onclick="window.scrollTo(0, 0)">
          <span class="cz-handheld-toolbar-icon"><i class="czi-menu"></i></span>
          <span class="cz-handheld-toolbar-label">Menu</span>
        </a>
        <a class="d-table-cell cz-handheld-toolbar-item" href="{{$empresa->slug. '/cart'}}">
          <span class="cz-handheld-toolbar-icon"><i class="czi-cart"></i>
            <span class="badge badge-primary badge-pill ml-1">3</span>
          </span>
          <span class="cz-handheld-toolbar-label">$24.00</span>
        </a>
      </div>
    </div>

    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <script src='{{asset('js/catalogo/jquery.slim.min.js')}}'></script>
    <script src='{{asset('js/catalogo/bootstrap.bundle.min.js')}}'></script>
    <script src='{{asset('js/catalogo/bs-custom-file-input.min.js')}}'></script>
    <script src='{{asset('js/catalogo/simplebar.min.js')}}'></script>
    <script src='{{asset('js/catalogo/tiny-slider.js')}}'></script>
    <script src='{{asset('js/catalogo/smooth-scroll.polyfills.min.js')}}'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src='{{asset('js/catalogo/theme.min.js')}}'></script>

    <script type="text/javascript">

      // function updateCart(){
      //   $(".update-cart").click(function (e) {
      //     e.preventDefault();
      //     var ele = $(this);
      //     $.ajax({
      //       url: '{{ url('atualizarCarrinho') }}',
      //       method: "patch",
      //       data: {
      //         _token: '{{ csrf_token() }}',
      //         id: ele.attr("data-id"),
      //         quantity: ele.parents("tr").find(".quantity").val()
      //       },
      //       success: function (response) {
      //         window.location.reload();
      //       }
      //     });
      //   });
      // }

      $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        console.log(e)
        var ele = $(this);
        if(confirm("Você tem certeza que deseja remover este produto do pedido?")) {
          $.ajax({
            url: '{{ url('removerDoCarrinho') }}',
            method: "DELETE",
            data: {
              _token: '{{ csrf_token() }}',
              id: ele.attr("data-id")
            },
            success: function (response) {
              window.location.reload();
            }
          });
        }
      });

      $(document).ready(function () {
        $('#su-telefone').mask('(00) 00000-0000');
      });
    </script>
    @stack('scripts')
  </body>

  </html>

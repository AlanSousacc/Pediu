<!DOCTYPE html>
<html lang="PT-br">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="keywords" content="Sistema de controle de entregas e pedidos.">
  <meta name="description" content="Sistema desenvolvido para solucionar problema de gestão de entrega de pedidos feitos por delivery.">
  <meta name="searchUrl" content="{{route('search.item')}}">
  <meta name="getItemFromGroup" content="{{route('get.item.from.group')}}">
  <meta name="getItemsPizza" content="{{route('get.item.pizza')}}">
  <meta name="getConfigEmpresa" content="{{route('get.config.empresa')}}">
  <meta name="getContatos" content="{{route('lista.contatos.pedido')}}">
  <meta name="getEnderecoCliente" content="{{route('get.endereco.cliente')}}">
  <meta name="processaPedidoBalcao" content="{{route('processa.pedido.balcao')}}">
  <meta name="editarPedido" content="{{route('editar.pedido')}}">
  <meta name="imprimir" content="{{route('imprimir.pedido.venda')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
    @auth
    {{Auth::user()->empresa->fantasia}}
    @endauth
    @guest
    PediuApp
    @endguest
  </title>
  {{-- livewire import --}}
  
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- CSS Files -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
  
  <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ asset('assets') }}/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('assets') }}/demo/demo.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  
  <link href='{{asset('assets/css/style.css')}}' rel='stylesheet' />
</head>

<body class="{{ $class ?? '' }}">
  <div class="wrapper">
    @auth
    @include('layouts.page_template.auth')
    @endauth
    @guest
    @include('layouts.page_template.guest')
    @endguest
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('js/jquery.js')}}"></script>
  <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
  <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
  <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
  <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="{{ asset('assets') }}/js/plugins/bootstrap-notify.js"></script>
  <script src="{{ asset('assets') }}/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <script src="{{ asset('assets') }}/demo/demo.js"></script>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>


  @stack('scripts')
</body>

</html>

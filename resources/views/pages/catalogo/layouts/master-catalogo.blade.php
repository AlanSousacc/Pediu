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
  @yield('content')

  <script src='{{asset('js/catalogo/jquery.slim.min.js')}}'></script>
  <script src='{{asset('js/catalogo/bootstrap.bundle.min.js')}}'></script>
  <script src='{{asset('js/catalogo/bs-custom-file-input.min.js')}}'></script>
  <script src='{{asset('js/catalogo/simplebar.min.js')}}'></script>
  <script src='{{asset('js/catalogo/tiny-slider.js')}}'></script>
  <script src='{{asset('js/catalogo/smooth-scroll.polyfills.min.js')}}'></script>
  <script src='{{asset('js/catalogo/theme.min.js')}}'></script>
  @stack('scripts')

</body>

</html>

@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
          <li class="nav-item"><a class="nav-link active" href="#signin-tab" data-toggle="tab" role="tab" aria-selected="true"><i class="czi-unlocked mr-2 mt-n1"></i>Sign in</a></li>
          <li class="nav-item"><a class="nav-link" href="#signup-tab" data-toggle="tab" role="tab" aria-selected="false"><i class="czi-user mr-2 mt-n1"></i>Sign up</a></li>
        </ul>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body tab-content py-4">
        <form class="needs-validation tab-pane fade show active" autocomplete="off" novalidate id="signin-tab">
          <div class="form-group">
            <label for="si-email">Email address</label>
            <input class="form-control" type="email" id="si-email" placeholder="johndoe@example.com" required>
            <div class="invalid-feedback">Please provide a valid email address.</div>
          </div>
          <div class="form-group">
            <label for="si-password">Password</label>
            <div class="password-toggle">
              <input class="form-control" type="password" id="si-password" required>
              <label class="password-toggle-btn">
                <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Show password</span>
              </label>
            </div>
          </div>
          <div class="form-group d-flex flex-wrap justify-content-between">
            <div class="custom-control custom-checkbox mb-2">
              <input class="custom-control-input" type="checkbox" id="si-remember">
              <label class="custom-control-label" for="si-remember">Remember me</label>
            </div><a class="font-size-sm" href="#">Forgot password?</a>
          </div>
          <button class="btn btn-primary btn-block btn-shadow" type="submit">Sign in</button>
        </form>
        <form class="needs-validation tab-pane fade" autocomplete="off" novalidate id="signup-tab">
          <div class="form-group">
            <label for="su-name">Full name</label>
            <input class="form-control" type="text" id="su-name" placeholder="John Doe" required>
            <div class="invalid-feedback">Please fill in your name.</div>
          </div>
          <div class="form-group">
            <label for="su-email">Email address</label>
            <input class="form-control" type="email" id="su-email" placeholder="johndoe@example.com" required>
            <div class="invalid-feedback">Please provide a valid email address.</div>
          </div>
          <div class="form-group">
            <label for="su-password">Password</label>
            <div class="password-toggle">
              <input class="form-control" type="password" id="su-password" required>
              <label class="password-toggle-btn">
                <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Show password</span>
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="su-password-confirm">Confirm password</label>
            <div class="password-toggle">
              <input class="form-control" type="password" id="su-password-confirm" required>
              <label class="password-toggle-btn">
                <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Show password</span>
              </label>
            </div>
          </div>
          <button class="btn btn-primary btn-block btn-shadow" type="submit">Sign up</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Navbar-->
<!-- Floating Navbar (Transparent version)-->
<header class="navbar d-block navbar-sticky navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <div class="navbar-toolbar d-flex align-items-center order-lg-3">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-tool d-none d-lg-flex" href="#searchBox" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="searchBox">
        <span class="navbar-tool-tooltip">Search</span>
        <div class="navbar-tool-icon-box">
          <i class="fa fa-search"></i>
        </div>
      </a>
      <a class="navbar-tool ml-2" href="#signin-modal" data-toggle="modal">
        <span class="navbar-tool-tooltip">Account</span>
        <div class="navbar-tool-icon-box">
          <i class="far fa-user"></i>
        </div>
      </a>
      <div class="navbar-tool dropdown ml-3">
        <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="food-delivery-cart.html">
          <span class="navbar-tool-label">3</span><i class="fas fa-shopping-cart"></i>
        </a>
      </div>
    </div>
    <div class="collapse navbar-collapse mr-auto order-lg-2" id="navbarCollapse">
      <!-- Search (mobile)-->
      <div class="d-lg-none py-3">
        <div class="input-group-overlay">
          <div class="input-group-prepend-overlay">
            <span class="input-group-text">
              <i class="fa fa-search"></i>
            </span>
          </div>
          <input class="form-control prepended-form-control" type="text" placeholder="O que está buscando?">
        </div>
      </div>
      <!-- Location dropdown-->
      <!-- Primary menu-->
      {{-- <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{url('catalogo', $empresa->slug)}}" data-toggle="dropdown">{{ $empresa->razao}}</a>
        </li>
      </ul> --}}
    </div>
  </div>
  <!-- Search collapse-->
  <div class="search-box collapse" id="searchBox">
    <div class="container py-2">
      <div class="input-group-overlay">
        <div class="input-group-prepend-overlay">
          <span class="input-group-text"><i class="fa fa-search"></i>
          </span>
        </div>
        <input class="form-control prepended-form-control" type="text" placeholder="O que está buscando?">
      </div>
    </div>
  </div>
</header>

<!-- Quick View Modal-->
<div class="modal-quick-view modal fade" id="quick-view" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pizza with Salami and Olives</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Product gallery-->
          <div class="col-lg-7 col-md-6 pr-lg-0"><img src="img/food-delivery/restaurants/single/large-preview.jpg" alt="Pizza"/>
          </div>
          <!-- Product details-->
          <div class="col-lg-5 col-md-6 pt-4 pt-lg-0">
            <div class="product-details ml-auto pb-3">
              <div class="mb-3"><span class="h3 font-weight-normal text-accent mr-1">$15.<small>99</small></span></div>
              <form class="mb-grid-gutter">
                <div class="row mx-n2">
                  <div class="col-6 px-2">
                    <div class="form-group">
                      <label class="font-weight-medium pb-1" for="pizza-size">Size:</label>
                      <select class="custom-select" id="pizza-size">
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-6 px-2">
                    <div class="form-group">
                      <label class="font-weight-medium pb-1" for="pizza-base">Base:</label>
                      <select class="custom-select" id="pizza-base">
                        <option value="standard">Standard</option>
                        <option value="thin">Thin</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group d-flex align-items-center">
                  <select class="custom-select mr-3" style="width: 5rem;">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                  <button class="btn btn-primary btn-shadow btn-block" type="submit"><i class="czi-cart font-size-lg mr-2"></i>Add to Cart</button>
                </div>
              </form>
              <h5 class="h6 mb-3 pb-3 border-bottom"><i class="czi-announcement text-muted font-size-lg align-middle mt-n1 mr-2"></i>Product info</h5>
              <h6 class="font-size-sm mb-2">Ingredients:</h6>
              <p class="font-size-sm">Salami, Olives, Bell pepper, Mushrooms, Mozzarella, Parmesan</p>
              <h6 class="font-size-sm mb-2">Allergies</h6>
              <p class="font-size-sm">Gluten, Dairy</p>
              <h6 class="font-size-sm mb-2">Calories</h6>
              <p class="font-size-sm mb-0">811</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page title-->
<!-- Page Content-->
<!-- Page title-->
<section class="bg-darker bg-size-cover bg-position-center py-5" style="background-image: url(img/food-delivery/restaurants/single/pt-bg.jpg);">
  <div class="container py-md-4">
    <h1 class="text-light text-center text-lg-left py-3">{{$empresa->fantasia}}</h1>
  </div>
</section>
<!-- Page navigation-->
<nav class="container mt-n5">
  <div class="media align-items-center bg-white rounded-lg box-shadow-lg py-2 pl-sm-2 pr-4 pr-lg-2">
    <img width="142" src="{{$empresa->logo == 'default.png' ? asset('assets/img/pediu.png') : url("storage/" .$empresa->logo)}}" alt="{{ $empresa->razao}}"/>
    <div class="media-body text-right">
      <!-- For desktop-->
      <ul class="nav nav-tabs d-none d-lg-flex border-0 mb-0">
        @foreach ($grupos as $item)
        <li class="nav-item"><a class="nav-link active" href="#">{{$item->descricao}}</a></li>
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
<!-- Menu (Products grid)-->
<section class="container tab-content py-4 py-sm-5">
  <h2 class="text-center pt-2 pt-sm-0 mb-sm-5">Pizza</h2>
  <div class="row pt-3 pt-sm-0">
    <!-- Item-->
    @foreach ($produtos as $item)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-grid-gutter">
      <div class="card product-card border pb-2">
        <a class="d-block" href="#quick-view" data-toggle="modal">
          <img class="card-img-top" src="{{ $item->foto != 'default.png' ? url("storage/".$item->foto) : url("storage/img/logos/default.png")}}" alt="{{$item->descricao}}"/>
        </a>
        <div class="card-body pt-1 pb-2">
          <h3 class="product-title font-size-md">
            <a href="#quick-view" data-toggle="modal">{{$item->descricao}}</a>
          </h3>
          <p class="font-size-ms text-muted">{{$item->composicao}}</p>
          <div class="d-flex mb-1">
            <div class="custom-control custom-option custom-control-justified mb-2">
              <input class="custom-control-input" type="radio" name="size1" id="s1" checked>
              <label class="custom-option-label" for="s1">Pequeno</label>
            </div>
            <div class="custom-control custom-option custom-control-justified mb-2">
              <input class="custom-control-input" type="radio" name="size1" id="m1">
              <label class="custom-option-label" for="m1">Médio</label>
            </div>
            <div class="custom-control custom-option custom-control-justified mb-2">
              <input class="custom-control-input" type="radio" name="size1" id="l1">
              <label class="custom-option-label" for="l1">Grande</label>
            </div>
          </div>
          <div class="d-flex mb-3">
            <div class="custom-control custom-option custom-control-justified mb-2">
              <input class="custom-control-input" type="radio" name="base1" id="standard1" checked>
              <label class="custom-option-label" for="standard1">Standard</label>
            </div>
            <div class="custom-control custom-option custom-control-justified mb-2">
              <input class="custom-control-input" type="radio" name="base1" id="thin1">
              <label class="custom-option-label" for="thin1">Thin</label>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div class="product-price">
              <span class="text-accent">R$ {{number_format($item->precovenda, 2, ',', '.')}}</span>
            </div>
            <button class="btn btn-primary btn-sm" type="button" data-toggle="toast" data-target="#cart-toast">
              + <i class="fas fa-cart-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </section>
  <!-- Toast: Added to Cart-->
  <div class="toast-container toast-bottom-center">
    <div class="toast mb-3" id="cart-toast" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header bg-success text-white">
        <i class="czi-check-circle mr-2"></i>
        <h6 class="font-size-sm text-white mb-0 mr-auto">Added to cart!</h6>
        <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">This item has been added to your cart.</div>
    </div>
  </div>
  <!-- Footer-->
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
    <div class="d-table table-fixed w-100"><a class="d-table-cell cz-handheld-toolbar-item" href="#signin-modal" data-toggle="modal"><span class="cz-handheld-toolbar-icon"><i class="czi-user"></i></span><span class="cz-handheld-toolbar-label">Account</span></a><a class="d-table-cell cz-handheld-toolbar-item" href="#navbarCollapse" data-toggle="collapse" onclick="window.scrollTo(0, 0)"><span class="cz-handheld-toolbar-icon"><i class="czi-menu"></i></span><span class="cz-handheld-toolbar-label">Menu</span></a><a class="d-table-cell cz-handheld-toolbar-item" href="food-delivery-cart.html"><span class="cz-handheld-toolbar-icon"><i class="czi-cart"></i><span class="badge badge-primary badge-pill ml-1">3</span></span><span class="cz-handheld-toolbar-label">$24.00</span></a>
    </div>
  </div>
  <a class="btn-scroll-top" href="#top" data-scroll>
    <span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">Top</span>
    <i class="btn-scroll-top-icon czi-arrow-up">   </i>
  </a>

  @endsection

@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
@extends('pages.catalogo.layouts.modal-login-register')
<section class="container tab-content py-4 py-sm-5">
  <div class="col-md-8 offset-md-2 fixed-bottom mt-3 text-center" style="z-index: 9999;">
    @if($errors->any())
    <div class="alert alert-danger" data-notify="container">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span data-notify="icon" class="now-ui-icons travel_info"></span>
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif

    @if(\Session::has('success'))
    <div class="alert alert-success" data-notify="container">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span data-notify="icon" class="now-ui-icons ui-1_check"></span>
      <span data-notify="message">{{\Session::get('success')}}</span>
    </div>
    @elseif(\Session::has('error'))
    <div class="alert alert-danger" data-notify="container">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span data-notify="icon" class="now-ui-icons travel_info"></span>
      <span data-notify="message">{{\Session::get('error')}}</span>
    </div>
    @endif
  </div>

  <h2 class="text-center pt-2 pt-sm-0 mb-sm-5">{{!isset($grupo) ? 'Catalogo de produtos' : $grupo->descricao}}</h2>
  <div class="row pt-3 pt-sm-0">
    @foreach ($produtos as $item)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-grid-gutter">
      <div class="card product-card border pb-2">
        <a class="d-block" href="{{route('catalogo-detalhe-produto',array($empresa->slug, $item->id))}}">
          <img class="card-img-top" src="{{ $item->foto != 'default.png' ? url("storage/".$item->foto) : url("storage/img/logos/default.png")}}" alt="{{$item->descricao}}"/>
        </a>
        <div class="card-body pt-1 pb-2">
          <h3 class="product-title font-size-md">
            <a href="{{route('catalogo-detalhe-produto',array($empresa->slug, $item->id))}}">{{$item->descricao}}</a>
          </h3>
          <p class="font-size-ms text-muted">{{$item->composicao}}</p>
          {{-- <div class="d-flex mb-1">
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
          </div> --}}
          <div class="d-flex align-items-center justify-content-between">
            <div class="product-price">
              <span class="text-accent">R$ {{number_format($item->precovenda, 2, ',', '.')}}</span>
            </div>
            @if (!auth()->check())
              <a class="navbar-tool ml-2" href="#signin-modal" data-toggle="modal">
                <i class="far fa-user mr-2"></i> Entrar
              </a>
            @else
              <a class="btn btn-primary btn-sm" href="{{route('add-to-cart', $item->id)}}">
                + <i class="fas fa-cart-plus"></i>
              </a>
            @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>

  @push('scripts')
  <script src='{{asset('js/catalogo/grid-produtos/modal-produtos.js')}}'></script>
  @endpush
  @endsection

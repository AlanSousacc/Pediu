@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
@extends('pages.catalogo.layouts.modal-login-register')
<section class="container tab-content py-4 py-sm-5">
  <h2 class="text-center pt-2 pt-sm-0 mb-sm-5 font-weight-light">{{!isset($grupo) ? 'Confira nosso catalogo' : $grupo->descricao}}</h2>
  <div class="row pt-3 pt-sm-0">
    @foreach ($produtos as $item)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-grid-gutter product_data">
      <div class="card product-card border pb-2">
        <a class="d-block" href="{{route('catalogo-detalhe-produto',array($empresa->slug, $item->id))}}">
          <input type="hidden" class="product_id" value="{{$item->id}}">
          <input type="hidden" class="qty-input" value="1">
          <img class="card-img-top" src="{{ $item->foto != 'default.png' ? url("storage/".$item->foto) : url("storage/img/logos/default.png")}}" alt="{{$item->descricao}}"/>
        </a>
        <div class="card-body pt-1 pb-2">
          <h3 class="product-title font-size-md">
            <a href="{{route('catalogo-detalhe-produto',array($empresa->slug, $item->id))}}">{{$item->descricao}}</a>
          </h3>
          <p class="font-size-ms text-muted">{{$item->composicao}}</p>
          <div class="d-flex align-items-center justify-content-between">
            <div class="product-price">
              <span class="text-accent">R$ {{number_format($item->precovenda, 2, ',', '.')}}</span>
            </div>
            @if (!auth()->check())
            <a class="navbar-tool ml-2" href="#signin-modal" data-toggle="modal">
              <i class="far fa-user mr-2"></i> Entrar
            </a>
            @else
            <a href="{{route('catalogo-detalhe-produto',array($empresa->slug, $item->id))}}">Detalhe <i class="fas fa-cart-plus"></i></a>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>
{{-- </section> --}}

@push('scripts')
@endpush
@endsection

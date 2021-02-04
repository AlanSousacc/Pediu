@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
@extends('pages.catalogo.layouts.modal-login-register')

<section class="container tab-content py-4 py-sm-5">
<div class="row">
  <!-- Product gallery-->
  <div class="col-lg-7 col-md-6 pr-lg-0">
    <img src="{{ $produto->foto != 'default.png' ? url("storage/".$produto->foto) : url("storage/img/logos/default.png")}}" alt="{{$produto->descricao}}" alt="{{$produto->descricao }}"/>
  </div>
  <!-- Product details-->
  <div class="col-lg-5 col-md-6 pt-4 pt-lg-0">
    <div class="product-details ml-auto pb-3">
      <h4 class="modal-title" id="descricao">{{$produto->descricao}}</h4>
      <div class="mb-3"><small>R$</small><span class="h3 font-weight-normal text-accent mr-1" id="precovenda"> {{number_format($produto->precocusto, 2, ',', '.')}}</span></div>
      <form class="mb-grid-gutter">
        <div class="row mx-n2">
          {{-- <div class="col-6 px-2">
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
          </div> --}}
        </div>
        <div class="form-group d-flex align-items-center">
          <select class="custom-select mr-3" style="width: 5rem;">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
          <button class="btn btn-primary btn-shadow btn-block" type="submit"><i class="fas fa-cart-plus font-size-lg mr-2"></i>Adicionar ao Carrinho</button>
        </div>
      </form>
      <h5 class="h6 mb-3 pb-3 border-bottom"><i class="fa fa-info-circle text-muted font-size-lg align-middle mt-n1 mr-2"></i>Detalhes do Produto</h5>
      <h6 class="font-size-sm mb-2">Ingredients:</h6>
      <p class="font-size-sm" id="composicao">{{$produto->composicao}}</p>
    </div>
  </div>
</div>
</section>

@push('scripts')
    <script src='{{asset('js/catalogo/grid-produtos/modal-produtos.js')}}'></script>
  @endpush
  @endsection


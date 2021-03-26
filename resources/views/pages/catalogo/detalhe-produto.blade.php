@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
@extends('pages.catalogo.layouts.modal-login-register')

<section class="container tab-content py-4 py-sm-5">
  <div class="row">
    <!-- Product gallery-->
    <div class="col-lg-7 col-md-6 pr-lg-0 text-center">
      <img src="{{ $produto->foto != 'default.png' ? url("storage/".$produto->foto) : url("storage/img/logos/default.png")}}" alt="{{$produto->descricao}}" alt="{{$produto->descricao }}"/>
    </div>
    <!-- Product details-->
    <div class="col-lg-5 col-md-6 pt-4 pt-lg-0 product_data">
      <div class="product-details ml-auto pb-3">
        <h4 class="modal-title" id="descricao">{{$produto->descricao}}</h4>
        <div class="mb-3"><small>R$</small><span class="h3 font-weight-normal text-accent mr-1" id="precovenda"> {{number_format($produto->precovenda, 2, ',', '.')}}</span></div>
        <form class="mb-grid-gutter">
          <div class="row mx-n2">
            @if ($produto->controlatamanho)
            <div class="col-12 px-2">
              <div class="mb-3">
                <label class="form-label" for="pizza-size">Tamanho:</label>
                <select class="form-select" id="pizza-size">
                  <option value="small">Pequeno R$ {{number_format($produto->precopequeno, 2, ',', '.')}}</option>
                  <option value="medium">Médio R$ {{number_format($produto->precomedio, 2, ',', '.')}}</option>
                  <option value="large">Grande R$ {{number_format($produto->precogrande, 2, ',', '.')}}</option>
                </select>
              </div>
            </div>
            @endif
          </div>
          <input type="hidden" class="product_id" value="{{$produto->id}}">
          <input type="hidden" class="qty-input" value="1">
          <div class="form-group d-flex align-items-center">
            <select class="custom-select mr-3" id="qtdeselect" style="width: 5rem;">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
            <button class="btn btn-primary btn-shadow btn-block add-to-cart-btn" type="submit">
              <i class="fas fa-cart-plus font-size-lg mr-2"></i> Adicionar ao Carrinho
            </button>
          </div>
        </form>
        <h5 class="h6 mb-3 pb-3 border-bottom"><i class="fa fa-info-circle text-muted font-size-lg align-middle mt-n1 mr-2"></i>Detalhes do Produto</h5>
        <h6 class="font-size-sm mb-2">Ingredientes:</h6>
        <p class="font-size-sm border-bottom pb-1" id="composicao">{{$produto->composicao}}</p>
        <h6 class="font-size-sm mb-2">Adicional:</h6>
        @foreach ($produto->complementos as $item)
        <div class="form-check d-inline pr-3">
          <input class="form-check-input" type="checkbox" name="complemento_id[]" value='{{$item->id}}' id="complemento_id[{{$item->id}}]">
          <label class="form-check-label" for="complemento_id[{{$item->id}}]">{{$item->descricao}} <small>R$</small> {{number_format($item->preco, 2, ',', '.')}}</label>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  $("#qtdeselect").change(function(){
    var qtde = $(this).val();
    $('.qty-input').val(qtde);
  });
</script>
@endpush
@endsection


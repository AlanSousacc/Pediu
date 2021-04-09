@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
@extends('pages.catalogo.layouts.modal-login-register')
@extends('layouts.messages.message-loja')
<section class="container tab-content py-4 py-sm-5">
  <div class="rounded-lg box-shadow-lg mt-4 mb-5">
    <ul class="nav nav-tabs nav-justified mb-4">
      <li class="nav-item"><a class="nav-link font-size-lg font-weight-medium py-4 active" href="{{route('cart', $empresa->slug)}}"">1. Seu Pedido</a></li>
      <li class="nav-item"><a class="nav-link font-size-lg font-weight-medium py-4" href="{{route('checkout', $empresa->slug)}}">2. Entrega / Pagamento</a></li>
    </ul>
    <div class="px-3 px-sm-4 px-xl-5 pt-1 pb-4 pb-sm-5">
      <div class="row">
        <!-- Items in cart-->
        <div class="col-lg-8 col-md-7 pt-sm-2">
          <!-- Item-->
          @if(isset($cart_data) && auth()->check())
          @if (Cookie::get('shopping_cart'))
          @foreach ($cart_data as $data)
          @if ($data['user_id'] == auth()->user()->id)
          <div class="d-sm-flex justify-content-between align-items-center mt-3 mb-4 pb-3 border-bottom cartpage">
            <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left">
              <a class="d-inline-block mx-auto mr-sm-4" href="{{route('catalogo-detalhe-produto',array($empresa->slug, $data['item_id']))}}" style="width: 7.5rem;">
                <img src="{{ $data['item_image'] == 'default.png' ? url("storage/img/logos/".$data['item_image']) : url("storage/".$data['item_image'])}}" alt="{{$data['item_name']}}">
              </a>
              <div class="media-body pt-2">
                <h3 class="product-title font-size-base mb-2">
                  <a href="{{route('catalogo-detalhe-produto',array($empresa->slug, $data['item_id']))}}">{{$data['item_name']}}</a>
                </h3>
                <div class="font-size-sm">
                  @if ($data['meio_a_meio'] != null)
                  <span class="text-muted me-2">Sabores:
                    @foreach ($data['meio_a_meio'] as $item)
                      @foreach ($produtos->where('id', $item) as $produto)
                      <span class="badge badge-primary">{{$produto->descricao}}</span>
                      @endforeach
                    @endforeach
                  </span>
                  @endif
                </div>
                @if ($data['item_observacao'] != null)
                @endif
                <div class="font-size-sm">
                  @if ($data['complem_produ'] != null)
                  <span class="text-muted me-2">Adicionais:
                    @foreach ($data['complem_produ'] as $item)
                      @foreach ($complementos->where('id', $item) as $complemento)
                      <span class="badge badge-dark">{{$complemento->descricao}}</span>
                      @endforeach
                    @endforeach
                    </span>
                  @endif
                </div>
                <div class="font-size-sm"><span class="text-muted me-2">Observação: </span><span class="badge badge-warning">{{$data['item_observacao']}}</span></div>
                <div class="font-size-sm"><span class="text-muted me-2">Ingredientes: </span><span class="font-italic">{{$data['prod_comp']}}</span></div>
                <div class="font-size-lg text-accent pt-2"><small>R$</small> {{ number_format($data['item_price'], 2, ',', '.')}} unit.</div>
              </div>
            </div>
            <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left" style="max-width: 9rem;" data-id="{{ $data['item_id'] }}">
              <div class="input-group quantity d-none">
                <div class="input-group-prepend decrement-btn changeQuantity" style="cursor: pointer">
                  <span class="input-group-text" style="padding: 7px 15px 7px 15px!important;">-</span>
                </div>
                <input type="hidden" class="product_id" value="{{ $data['item_id'] }}" >
                <input type="text" class="qty-input form-control text-center" maxlength="2" max="10" value="{{ $data['item_quantity'] }}">
                <div class="input-group-append increment-btn changeQuantity" style="cursor: pointer">
                  <span class="input-group-text" style="padding: 7px 15px 7px 15px!important;">+</span>
                </div>
              </div>
              <label for="name" class="text-center w-100">{{ $data['item_quantity'] }} Unid.</label>
              <button class="btn btn-danger px-1 text-white delete_cart_data w-100" type="button"><i class="fa fa-times font-size-lg mr-2"></i><span class="font-size-sm">Remover</span></button>
            </div>
          </div>
          @endif
          @endforeach
          @endif
          @endif
          {{-- end item --}}
        </div>
        <!-- Sidebar-->
        <div class="col-lg-4 col-md-5 pt-3 pt-sm-4">
          <div class="rounded-lg bg-secondary px-3 px-sm-4 py-4">
            <h3 class="h5 mb-4 text-center">RESUMO DO SEU PEDIDO</h3>
            <div class="text-left mb-4 pb-3 border-bottom">
              <div class="row">
                <h6 class="col-md-6 mb-3 pb-1 text-left">Produtos</h6>
                <h6 class="col-md-6 font-weight-normal text-right"><small>R$</small> {{number_format($totalprodutos, 2, ',', '.')}}</h6>
              </div>

              <div class="row">
                <h6 class="col-md-6 mb-3 pb-1 text-left">Adicionais</h6>
                <h6 class="col-md-6 font-weight-normal text-right"><small>R$</small> {{number_format($totaladicional, 2, ',', '.')}}</h6>
              </div>
              <hr>
              <div class="row">
                <h3 class="col-md-6 h5 pb-1 mb-0 pt-3 text-left">Total</h3>
                <h4 class="col-md-6 mb-0 font-weight-normal pt-3 text-right"><small>R$</small> {{ number_format($totalprodutos + $totaladicional, 2, ',', '.')}}</h4>
              </div>
            </div>
            <a class="btn btn-success btn-shadow btn-block mt-4 mb-3" href="checkout"><i class="fa fa-credit-card font-size-lg mr-2"></i>Checkout</a>
            <a class="btn btn-warning btn-shadow btn-block clearcart mt-4 mb-3"><i class="fa fa-trash  font-size-lg mr-2"></i></i>Limpar Carrinho</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

@push('scripts')
@endpush
@endsection


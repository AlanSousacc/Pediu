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
          @php $total = "0" @endphp
          @foreach ($cart_data as $data)
          @if ($data['user_id'] == auth()->user()->id)
          <div class="d-sm-flex justify-content-between align-items-center mt-3 mb-4 pb-3 border-bottom cartpage">
            <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left">
              <a class="d-inline-block mx-auto mr-sm-4" href="#" style="width: 7.5rem;">
                <img src="{{ $data['item_image'] == 'default.png' ? url("storage/img/logos/".$data['item_image']) : url("storage/".$data['item_image'])}}" alt="{{$data['item_name']}}">
              </a>
              <div class="media-body pt-2">
                <h3 class="product-title font-size-base mb-2">
                  <a href="#">{{$data['item_name']}}</a>
                </h3>
                <div class="font-size-sm">{{$data['prod_comp']}}</div>
                <div class="font-size-lg text-accent pt-2"><small>R$</small> {{ number_format($data['item_price'], 2, ',', '.')}}</div>
              </div>
            </div>
            <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left" style="max-width: 9rem;" data-id="{{ $data['item_id'] }}">
              <div class="input-group quantity">
                <div class="input-group-prepend decrement-btn changeQuantity" style="cursor: pointer">
                  <span class="input-group-text">-</span>
                </div>
                <input type="hidden" class="product_id" value="{{ $data['item_id'] }}" >
                <input type="text" class="qty-input form-control text-center" maxlength="2" max="10" value="{{ $data['item_quantity'] }}">
                <div class="input-group-append increment-btn changeQuantity" style="cursor: pointer">
                  <span class="input-group-text">+</span>
                </div>
              </div>
              <button class="btn btn-link px-0 text-danger delete_cart_data" type="button"><i class="fa fa-times font-size-lg mr-2"></i><span class="font-size-sm">Remover</span></button>
            </div>
          </div>
          @php $total = $total + ($data["item_quantity"] * $data["item_price"]) @endphp
          @endif
          @endforeach
          @endif
          @endif
          {{-- end item --}}
        </div>
        <!-- Sidebar-->
        <div class="col-lg-4 col-md-5 pt-3 pt-sm-4">
          <div class="rounded-lg bg-secondary px-3 px-sm-4 py-4">
            <div class="text-center mb-4 pb-3 border-bottom">
              <h3 class="h5 mb-3 pb-1">Total</h3>
              <h4 class="font-weight-normal"><small>R$</small> {{isset($total) ? number_format($total, 2, ',', '.') : '0,00'}}</h4>
            </div>
            <a class="btn btn-success btn-shadow btn-block mt-4 mb-3" href="checkout"><i class="fa fa-credit-card font-size-lg mr-2"></i>Checkout</a>
            <a href="javascript:void(0)" class="clear_cart font-weight-bold btn btn-primary btn-shadow btn-block mt-4 mb-3"><i class="fa fa-times-circle"></i> Limpar Carrinho</a>
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


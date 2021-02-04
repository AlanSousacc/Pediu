@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
@extends('pages.catalogo.layouts.modal-login-register')
<section class="container tab-content py-4 py-sm-5">
  <div class="rounded-lg box-shadow-lg mt-4 mb-5">
    <ul class="nav nav-tabs nav-justified mb-4">
      <li class="nav-item"><a class="nav-link font-size-lg font-weight-medium py-4 active" href="cart">1. Seu Pedido</a></li>
      <li class="nav-item"><a class="nav-link font-size-lg font-weight-medium py-4" href="checkout">2. Pagamento</a></li>
    </ul>
    <div class="px-3 px-sm-4 px-xl-5 pt-1 pb-4 pb-sm-5">
      <div class="row">
        <!-- Items in cart-->
        <div class="col-lg-8 col-md-7 pt-sm-2">
          @php $total = 0 @endphp
          <!-- Item-->
          @if (session('cart'))
          @foreach (session('cart') as $id => $details)
          @if ($details['user'] == auth()->user()->id) <!-- só vai listar os produtos da sessão se o id da sessao user id for igual o id do usuário logado-->
          @php $total += $details['precovenda'] * $details['quantity'] @endphp
          <div class="d-sm-flex justify-content-between align-items-center mt-3 mb-4 pb-3 border-bottom">
            <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left">
              <a class="d-inline-block mx-auto mr-sm-4" href="#" style="width: 7.5rem;">
                <img src="{{ url("storage/".$details['foto'])}}" alt="{{$details['descricao']}}">
              </a>
              <div class="media-body pt-2">
                <h3 class="product-title font-size-base mb-2">
                  <a href="#">{{$details['descricao']}}</a>
                </h3>
                <div class="font-size-sm">{{$details['composicao']}}</div>
                {{-- <div class="font-size-sm"><span class="text-muted mr-2">Size:</span>Medium</div>
                <div class="font-size-sm"><span class="text-muted mr-2">Base:</span>Standard</div> --}}
                <div class="font-size-lg text-accent pt-2">Unidade R$ {{ number_format($details['precovenda'], 2, ',', '.')}}</div>
              </div>
            </div>
            <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left" style="max-width: 9rem;" data-id="{{ $id }}">
              <div class="form-group mb-0">
                <label class="font-weight-medium" for="quantity">Quantidade</label>
                <input class="form-control text-center" type="number" id="quantity" value="{{$details['quantity']}}">
              </div>
              <button class="btn btn-link px-0 text-danger remove-from-cart" data-id="{{ $id }}" type="button"><i class="fa fa-times font-size-lg mr-2"></i><span class="font-size-sm">Remover</span></button>
            </div>
          </div>
          @endif
          @endforeach
          @endif
          {{-- end item --}}
        </div>
        <!-- Sidebar-->
        <div class="col-lg-4 col-md-5 pt-3 pt-sm-4">
          <div class="rounded-lg bg-secondary px-3 px-sm-4 py-4">
            <div class="text-center mb-4 pb-3 border-bottom">
              <h3 class="h5 mb-3 pb-1">Total</h3>
              <h4 class="font-weight-normal">R$ {{number_format($total, 2, ',', '.')}}</h4>
            </div>
            <div class="form-group mb-4">
              <label class="mb-3" for="order-comments"><span class="badge badge-info font-size-xs mr-2">Nota</span><span class="font-weight-medium">Comentário Adicional</span></label>
              <textarea class="form-control" rows="4" id="order-comments"></textarea>
            </div>
            <a class="btn btn-primary btn-shadow btn-block mt-4 mb-3" href="checkout"><i class="fa fa-credit-card font-size-lg mr-2"></i>check-out</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
@push('scripts')
<script src='{{asset('js/catalogo/grid-produtos/modal-produtos.js')}}'></script>
<script>
  $('#quantity').on('change',function(e){
    e.preventDefault();
    var ele = $(this);
    $.ajax({
      url: '{{ url('atualizarCarrinho') }}',
      method: "patch",
      data: {
        _token: '{{ csrf_token() }}',
        id: ele.attr("data-id"),
        quantity: ele.parents("tr").find(".quantity").val()
      },
      success: function (response) {
        console.log(ele);
        // window.location.reload();
      }
    });
  });
</script>
@endpush
@endsection


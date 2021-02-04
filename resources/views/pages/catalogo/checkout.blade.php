@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
@extends('pages.catalogo.layouts.modal-login-register')
<section class="container tab-content py-4 py-sm-5">
  <div class="rounded-lg box-shadow-lg mt-4 mb-5">
    <ul class="nav nav-tabs nav-justified mb-sm-4">
      <li class="nav-item"><a class="nav-link font-size-lg font-weight-medium py-4" href="cart">1. Seu Pedido</a></li>
      <li class="nav-item"><a class="nav-link font-size-lg font-weight-medium py-4 active" href="checkout">2. Entrega / Pagamento</a></li>
    </ul>
    <form class="needs-validation px-3 px-sm-4 px-xl-5 pt-sm-1 pb-4 pb-sm-5" novalidate>
      <h2 class="h5 pb-3">Endereço de Entrega</h2>
      <div class="row">
        <div class="col-sm-12 mb-4 mb-sm-0">
          <div class="custom-control custom-radio custom-control-inline mb-3">
            <input class="custom-control-input" type="radio" name="entrega" checked id="enderecocadastro">
            <label class="custom-control-label" for="enderecocadastro">Endereço de meu cadastro</label>
          </div>
        </div>
      </div>
      <div class="meu-endereco">
        <div class="row pb-4 pt-3">
          <div class="col-sm-6 mb-4">
            <label class="font-weight-medium" for="fd-name">Nome Completo</label>
            <input class="form-control" type="text" id="fd-name" name="name" value="{{auth()->check() ? auth()->user()->name : ''}}">
          </div>
          <div class="col-sm-6 mb-4">
            <label class="font-weight-medium" for="fd-phone">Telefone / Celular</label>
            <input class="form-control" type="text" id="fd-telefone" name="telefone" value="{{auth()->check() ? auth()->user()->telefone : ''}}">
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-sm-3 mb-4">
            <label class="font-weight-medium" for="fd-address">Endereço</label>
            <input class="form-control" type="text" placeholder="Rua" id="fd-endereco" name="endereco" value="{{auth()->check() ? auth()->user()->endereco : ''}}">
          </div>
          <div class="col-sm-2 mb-4">
            <label class="font-weight-medium" for="fd-address">Número</label>
            <input class="form-control" type="text" placeholder="123" id="fd-numero" name="numero" value="{{auth()->check() ? auth()->user()->numero : ''}}">
          </div>
          <div class="col-sm-3 mb-4">
            <label class="font-weight-medium" for="fd-city">Bairro</label>
            <input class="form-control" type="text" placeholder="Bairro" id="fd-bairro" name="bairro" value="{{auth()->check() ? auth()->user()->bairro : ''}}">
          </div>
          <div class="col-sm-4 mb-4">
            <label class="font-weight-medium" for="fd-city">Cidade</label>
            <input class="form-control" type="text" placeholder="Cidade" id="fd-cidade" name="cidade" value="{{auth()->check() ? auth()->user()->cidade : ''}}">
          </div>
        </div>
      </div>
      <hr class="my-4">
      <div class="row">
        <div class="col-sm-12 mb-4 mb-sm-0">
          <div class="custom-control custom-radio custom-control-inline mb-3">
            <input class="custom-control-input" type="radio" name="entrega" id="outroendereco">
            <label class="custom-control-label" for="outroendereco">Outro Endereço</label>
          </div>
        </div>
      </div>
      <div class="novo-endereco">
        <div class="row pb-4 pt-3">
          <div class="col-sm-6 mb-4">
            <label class="font-weight-medium" for="fd-name">Nome Completo</label>
            <input class="form-control" type="text" name="novo-nome" id="fd-name">
            <div class="invalid-feedback">Por favor informe seu nome completo!</div>
          </div>
          <div class="col-sm-6 mb-4">
            <label class="font-weight-medium" for="fd-telefone">Telefone / Celular</label>
            <input class="form-control" type="text" name="novo-telefone" id="fd-telefone">
            <div class="invalid-feedback">Por favor informa o numero do seu celular!</div>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-sm-6 mb-4">
            <label class="font-weight-medium" for="fd-endereco">Endereço</label>
            <input class="form-control" type="text" name="novo-endereco" placeholder="Rua, número do apartamento ou suíte" id="fd-endereco">
            <div class="invalid-feedback">Por Favor informe seu endereço!</div>
          </div>
          <div class="col-sm-6 mb-4">
            <label class="font-weight-medium" for="fd-numero">Número</label>
            <input class="form-control" type="text" name="novo-numero" placeholder="123">
            <div class="invalid-feedback">Por Favor informe o número da sua residência!</div>
          </div>
          <div class="col-sm-6 mb-4">
            <label class="font-weight-medium" for="fd-cidade">Cidade</label>
            <input class="form-control" type="text" placeholder="Cidade" name="novo-cidade" id="fd-cidade">
            <div class="invalid-feedback">Por Favor informe sua Cidade!</div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 mb-4">
          <label class="mb-3" for="fd-comments"><span class="badge badge-info font-size-xs mr-2">Nota</span><span class="font-weight-medium">Comentário Adicional de Pagamento e/ou Entrega</span></label>
          <textarea class="form-control" rows="5" id="fd-comments"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 mb-4 mb-sm-0">
          <h2 class="h5 pb-2">Pagamento na Entrega</h2>
          <div class="custom-control custom-radio custom-control-inline mb-3">
            <input class="custom-control-input" type="radio" name="payment" checked id="cash">
            <label class="custom-control-label" for="cash">Pagar em Dinheiro</label>
          </div>
          <div class="d-flex align-items-center">
            <label class="text-nowrap mr-3 mb-0" for="fd-change">Eu preciso de troca para:</label>
            <div class="input-group" style="width: 8rem;">
              <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-dollar-sign"></i></span></div>
              <input class="form-control bg-0 pr-3" type="text" id="fd-change">
            </div>
          </div>
          <hr class="my-4">
          <div class="custom-control custom-radio custom-control-inline pb-4">
            <input class="custom-control-input" type="radio" name="payment" id="online">
            <label class="custom-control-label" for="online">Pagar com Cartão:&nbsp;&nbsp;&nbsp;<img class="d-inline-block align-middle" src="{{asset('assets/img/cards.png')}}" style="width: 187px;" alt="Cerdit Cards"></label>
          </div>
          <button class="btn btn-primary btn-block mt-3" type="submit">Finalizar Pedido</button>
        </div>
        <div class="col-sm-6">
          @php $total = 0 @endphp
          @if (session('cart'))
            @foreach (session('cart') as $id => $details)
            @if ($details['user'] == auth()->user()->id) <!-- só vai listar os produtos da sessão se o id da sessao user id for igual o id do usuário logado-->
            @php $total += $details['precovenda'] * $details['quantity'] @endphp
            @endif
            @endforeach
          @endif
          <div class="d-fle flex-column h-100 rounded-lg bg-secondary px-3 px-sm-4 py-4">
            <h2 class="h5 pb-3">Total</h2>
            <div class="d-flex justify-content-between font-size-md border-bottom pb-3 mb-3"><span>Subtotal:</span><span class="text-heading"><small>R$</small> {{number_format($total, 2, ',', '.')}}</span></div>
            <div class="d-flex justify-content-between font-size-md border-bottom pb-3 mb-3"><span>Entrega:</span><span class="text-heading"><small>R$</small> {{isset($config) ? number_format($config->valorentrega, 2, ',', '.') : '0,00'}}</span></div>
            <div class="d-flex justify-content-between font-size-md mb-2"><span>Total:</span><span class="text-heading font-weight-medium"><small>R$</small> {{number_format($total + $config->valorentrega, 2, ',', '.')}}</span></div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</section>

@push('scripts')
<script src='{{asset('js/catalogo/grid-produtos/modal-produtos.js')}}'></script>
<script>
  function verificaentrega(){
    if($('#outroendereco').prop("checked")){
      $(".novo-endereco").css("display", "block")
      $(".meu-endereco").css("display", "none")
    } else {
      $(".novo-endereco").css("display", "none")
      $(".meu-endereco").css("display", "block")
    }
  }

  $('input[name=entrega]').on('change',function(ev){
    verificaentrega();
  });

  $(document).ready(function() {
    verificaentrega();
  });

</script>
@endpush
@endsection

@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
@extends('pages.catalogo.layouts.modal-login-register')
@extends('layouts.messages.message-loja')
<section class="container tab-content py-4 py-sm-5">
  <div class="rounded-lg box-shadow-lg mt-4 mb-5">
    <ul class="nav nav-tabs nav-justified mb-sm-4">
      <li class="nav-item"><a class="nav-link font-size-lg font-weight-medium py-4" href="cart">1. Seu Pedido</a></li>
      <li class="nav-item"><a class="nav-link font-size-lg font-weight-medium py-4 active" href="checkout">2. Entrega / Pagamento</a></li>
    </ul>
    <form action="{{ route('processa.pedido') }}" method="POST" class="needs-validation px-3 px-sm-4 px-xl-5 pt-sm-1 pb-4 pb-sm-5 checkoutpage" id="processpedido">
      @csrf
      <h2 class="h5 pb-3">Endereço de Entrega</h2>
      <div class="row">
        <div class="col-sm-12 mb-4 mb-sm-0">
          <div class="custom-control custom-radio custom-control-inline mb-3">
            <input class="custom-control-input" type="radio" name="entrega" value="enderecocadastro" checked id="enderecocadastro">
            <label class="custom-control-label" for="enderecocadastro">Endereço Principal</label>
          </div>
        </div>
      </div>
      <div class="meu-endereco">
        <div class="row pb-4 pt-3">
          <div class="col-sm-6 mb-4">
            <label class="font-weight-medium" for="fd-name">Nome Completo</label>
            <input class="form-control" type="text" id="fd-name" name="name" value="{{auth()->user()->name }}" readonly>
          </div>
          <div class="col-sm-6 mb-4">
            <label class="font-weight-medium" for="fd-phone">Telefone / Celular</label>
            <input class="form-control" type="text" id="fd-telefone" name="telefone" value="{{isset($endereco) ? $endereco->telefone : '' }}" readonly>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-sm-3 mb-4">
            <label class="font-weight-medium" for="fd-address">Endereço</label>
            <input class="form-control" type="text" placeholder="Rua" id="fd-endereco" name="endereco" value="{{isset($endereco) ? $endereco->endereco : '' }}" readonly>
          </div>
          <div class="col-sm-2 mb-4">
            <label class="font-weight-medium" for="fd-address">Número</label>
            <input class="form-control" type="text" placeholder="123" id="fd-numero" name="numero" value="{{isset($endereco) ? $endereco->numero : ''}}" readonly>
          </div>
          <div class="col-sm-3 mb-4">
            <label class="font-weight-medium" for="fd-city">Bairro</label>
            <input class="form-control" type="text" placeholder="Bairro" id="fd-bairro" name="bairro" value="{{isset($endereco) ? $endereco->bairro : '' }}" readonly>
          </div>
          <div class="col-sm-4 mb-4">
            <label class="font-weight-medium" for="fd-city">Cidade</label>
            <input class="form-control" type="text" placeholder="Cidade" id="fd-cidade" name="cidade" value="{{isset($endereco) ? $endereco->cidade : '' }}" readonly>
          </div>
        </div>
      </div>
      {{-- <hr class="my-4"> --}}
      <div class="row">
        <div class="col-sm-12 mb-4 mb-sm-0">
          <div class="custom-control custom-radio custom-control-inline">
            <input class="custom-control-input" type="radio" name="entrega" value="outroendereco" id="outroendereco">
            <label class="custom-control-label" for="outroendereco">Outro Endereço</label>
          </div>
        </div>
      </div>
      <div class="novo-endereco">
        <div class="row pb-4 pt-3">
          <div class="col-md-12 mb-4">
            @foreach ($enderecos as $item)
            <div class="custom-control custom-radio custom-control-inline mb-2">
              <input class="custom-control-input" type="radio" name="entrega_id" value="{{$item->id}}" id="{{$item->id}}">
              <label class="custom-control-label" for="{{$item->id}}">
                <strong>Rua:</strong> {{$item->endereco}} <br>
                <strong>Número:</strong> {{$item->numero}} <br>
                <strong>Bairro:</strong> {{$item->bairro}} <br>
                <strong>Cidade:</strong> {{$item->cidade}}
              </label>
            </div>
            @endforeach
            <br>
            <div class="custom-control custom-radio custom-control-inline my-3">
              <input class="custom-control-input" type="radio" name="entrega_id" value="novoendereco" id="outroendereconovo">
              <label class="custom-control-label" for="outroendereconovo">Novo Endereço</label>
            </div>
          </div>
        </div>
      </div>
      <div class="novo-endereco-form">
        <div class="row mb-4">
          <div class="col-sm-6 mb-4">
            <label class="font-weight-medium" for="novo-endereco">Endereço</label>
            <input class="form-control" type="text" name="novo-endereco" id="novo-endereco" placeholder="Rua, número do apartamento ou suíte" id="fd-endereco">
          </div>
          <div class="col-sm-6 mb-4">
            <label class="font-weight-medium" for="novo-numero">Número</label>
            <input class="form-control" type="text" name="novo-numero" id="novo-numero" placeholder="123">
          </div>
          <div class="col-sm-6 mb-4">
            <label class="font-weight-medium" for="nova-cidade">Cidade</label>
            <input class="form-control" type="text" placeholder="Cidade" id="nova-cidade" name="nova-cidade" id="novo-cidade">
          </div>
          <div class="col-sm-3 mb-4">
            <label class="font-weight-medium" for="novo-bairro">Bairro</label>
            <input class="form-control" type="text" placeholder="Bairro" id="novo-bairro" name="novo-bairro" >
          </div>
          <div class="col-sm-3 mb-4">
            <label class="font-weight-medium" for="novo-telefone">Telefone / Celular</label>
            <input class="form-control" type="text" name="novo-telefone" id="novo-telefone" placeholder="(99) 99999-9999">
          </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center">
        </div>
      </div>
      <hr class="my-3">
      <div class="row">
        <div class="col-sm-6 mb-4 mb-sm-0">
          <h2 class="h5 pb-2">Pagamento na Entrega</h2>
          <div class="custom-control custom-radio custom-control-inline mb-3">
            <input class="custom-control-input" type="radio" name="formapagamento" value="dinheiro" checked id="dinheiro">
            <label class="custom-control-label" for="dinheiro">Pagar em Dinheiro</label>
          </div>
          <div class="d-flex align-items-center divtrocopara">
            <label class="text-nowrap mr-3 mb-0" for="fd-change">Eu preciso de troca para:</label>
            <div class="input-group" style="width: 8rem;">
              <div class="input-group-prepend"><span class="input-group-text" style="padding: 7px 15px 7px 15px!important;"><i class="fa fa-dollar-sign"></i></span></div>
              <input class="form-control bg-0 pr-3" name="trocopara" id="trocopara" placeholder="0,00" type="text" id="fd-change">
            </div>
          </div>
          <hr class="my-4">
          <div class="custom-control custom-radio custom-control-inline pb-4">
            <input class="custom-control-input" type="radio" name="formapagamento" value="cartao" id="cartao">
            <label class="custom-control-label" for="cartao">Pagar com Cartão:&nbsp;&nbsp;&nbsp;<img class="d-inline-block align-middle" src="{{asset('assets/img/cards.png')}}" style="width: 187px;" alt="Cerdit Cards"></label>
          </div>
          <button class="btn btn-primary btn-block mt-3 finalizar-pedido" type="button">Finalizar Pedido</button>
        </div>
        <div class="col-sm-6">
          <div class="d-fle flex-column h-100 rounded-lg bg-secondary px-3 px-sm-4 py-4">
            <div class="row">
              <div class="col-12 mb-4">
                <label class="mb-3" for="observacaopedido"><span class="badge badge-info font-size-xs mr-2">Nota</span><span class="font-weight-medium">Comentário do pagamento, pedido e/ou Entrega</span></label>
                <textarea class="form-control" name="observacaopedido" placeholder="Descreva aqui uma observação do pedido, detalhe do pagamento ou informação de ponto de referência, para agilizar o processo de entrega." rows="5" id="observacaopedido"></textarea>
              </div>
            </div>
            <h2 class="h5 pb-3">Total</h2>
            <input type="hidden" name="totalpedido" id="totalpedido" value="{{$totalprodutos + $config->valorentrega}}">
            <input type="hidden" name="subtotalpedido" id="subtotalpedido" value="{{$totalprodutos}}">
            <div class="d-flex justify-content-between font-size-md border-bottom pb-3 mb-3"><span>Subtotal:</span><span class="text-heading"><small>R$</small> {{number_format($totalprodutos + $totaladicional, 2, ',', '.')}}</span></div>
            <div class="d-flex justify-content-between font-size-md border-bottom pb-3 mb-3"><span>Entrega:</span><span class="text-heading"><small>R$</small> {{isset($config) ? number_format($config->valorentrega, 2, ',', '.') : '0,00'}}</span></div>
            <div class="d-flex justify-content-between font-size-md mb-2"><span>Total:</span><span class="text-heading font-weight-medium"><small>R$</small> {{number_format($totalprodutos + $totaladicional + $config->valorentrega, 2, ',', '.')}}</span></div>
            <div class="d-flex justify-content font-size-md py-3 px-2 border-top bg-info text-white"><span>OBS:. O tempo médio de entrega é de: &nbsp</span> <span class="font-weight-medium"> {{$config->tempominimoentrega}}</span></div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</section>

@push('scripts')
<script src='{{asset('js/catalogo/scripts-custom.js')}}'></script>
<script>
  $(document).ready(function () {
    $('.finalizar-pedido').click(function (e) {
      Swal.fire({
        title: 'Finalizar Pedido?',
        text: "Você deseja enviar e finalizar seu pedido?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim',
      }).then((result) => {
        if (result.isConfirmed) {
          e.preventDefault();

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
            url: "/processa-pedido",
            method: "POST",
            data: $('#processpedido').serialize(),
            dataType: 'json',
            success: function (response) {
              let redirect = '{{route('profile.pedidos')}}' + '/' + response.slug + '/' + response.user
              Swal.fire({
                title: 'Pedido realizado com sucesso!',
                text: 'Recebemos seu pedido agora é só acompanhar seu pedido pelo painel de pedidos.',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok',
                allowOutsideClick: false
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = redirect;
                }
              });
            },

            error: function(response){
              Swal.fire(
                'Ops, algo deu errado!',
                'Infelizmente houve um problema interno, e não conseguimos processar seu pedido. Código: ' + response.status,
                'error'
              )
            }
          });
        }
      })
    });
  });
</script>
@endpush
@endsection

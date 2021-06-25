@extends('layouts.app', [
'namePage' => 'caixa do dia',
'class' => 'sidebar-mini',
'activePage' => 'caixa',
])

@section('content')
<div class="col-md-3 offset-md-9 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>

<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> CAIXA</h4>
          <small>DETALHAMENTO DO DIA</small>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card prod-p-card" style="background-color: #2dce89">
                <div class="card-body">
                  <div class="row align-items-center mb-30">
                    <div class="col">
                      <h6 class="mb-5 text-white">Total Dinheiro</h6>
                      <h3 class="mb-0 fw-700 text-white"><small>Loja</small> R$
                        {{number_format($totais['dinheiroloja'], '2', ',', '.')}}</h3>
                      @if ($config->controlepedidosbalcao)
                      <h3 class="mb-0 fw-700 text-white"><small>Balcao</small> R$
                        {{number_format($totais['dinheirobalc'], '2', ',', '.')}}</h3>
                      @endif
                    </div>
                    <div class="col-auto mr-3 bg-white py-3 px-3 rounded-circle">
                      <i class="fa fa-donate fa-2x text-success"></i>
                    </div>
                  </div>
                  <p class="mb-0 text-white"><span class="label label-danger mr-10">Total: </span>R$
                    {{number_format($totais['dinheiroloja'] + $totais['dinheirobalc'], '2', ',', '.')}}</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card prod-p-card" style="background-color: #007bff">
                <div class="card-body">
                  <div class="row align-items-center mb-30">
                    <div class="col">
                      <h6 class="mb-5 text-white">Total Crédito</h6>
                      <h3 class="mb-0 fw-700 text-white"><small>Loja</small> R$
                        {{number_format($totais['cardcredloja'], '2', ',', '.')}}</h3>
                      @if ($config->controlepedidosbalcao)
                      <h3 class="mb-0 fw-700 text-white"><small>Balcao</small> R$
                        {{number_format($totais['cardcredbalc'], '2', ',', '.')}}</h3>
                      @endif
                    </div>
                    <div class="col-auto mr-3 bg-white py-3 px-3 rounded-circle">
                      <i class="fab fa-cc-visa fa-2x text-info"></i>
                    </div>
                  </div>
                  <p class="mb-0 text-white"><span class="label label-danger mr-10">Total: </span>R$
                    {{number_format($totais['cardcredloja'] + $totais['cardcredbalc'], '2', ',', '.')}}</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card prod-p-card" style="background-color: #fb6340">
                <div class="card-body">
                  <div class="row align-items-center mb-30">
                    <div class="col">
                      <h6 class="mb-5 text-white">Total Débito</h6>
                      @if ($config->controlepedidosbalcao)
                      <h3 class="mb-0 fw-700 text-white"><small>Balcao</small> R$
                        {{number_format($totais['carddebibalc'], '2', ',', '.')}}</h3>
                      @endif
                    </div>
                    <div class="col-auto mr-3 bg-white py-3 px-3 rounded-circle">
                      <i class="fa fa-credit-card fa-2x text-primary"></i>
                    </div>
                  </div>
                  <p class="mb-0 text-white"><span class="label label-danger mr-10">Total: </span>R$
                    {{number_format($totais['carddebibalc'], '2', ',', '.')}}</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card prod-p-card" style="background-color: #f5365c">
                <div class="card-body">
                  <div class="row align-items-center mb-30">
                    <div class="col">
                      <h6 class="mb-5 text-white">Total Conta Cliente</h6>
                      @if ($config->controlepedidosbalcao)
                      <h3 class="mb-0 fw-700 text-white"><small>Balcao</small> R$
                        {{number_format($totais['contaclibalc'], '2', ',', '.')}}</h3>
                      @endif
                    </div>
                    <div class="col-auto mr-3 bg-white py-3 px-3 rounded-circle">
                      <i class="fa fa-folder-open fa-2x text-danger"></i>
                    </div>
                  </div>
                  <p class="mb-0 text-white"><span class="label label-danger mr-10">Total: </span>R$
                    {{number_format($totais['contaclibalc'], '2', ',', '.')}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-end">
    <div class="col-md-4" style="; position: fixed; bottom:0">
      <div id="accordion">
        <div class="card mb-1">
          <div class="card-header py-0" id="resumodia">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#resumoDia" aria-expanded="true" aria-controls="resumoDia">
                Resumo do dia {{date('d/m/Y')}}
              </button>
            </h5>
          </div>
      
          <div id="resumoDia" class="collapse" aria-labelledby="resumodia" data-parent="#accordion">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <th><a href="{{route('movimentacao.recebimentos.dia')}}">Recebimentos (A):</a><br>
                        <span style="font-weight: 400">Da Conta de clientes / Avulso</span>
                      </th>
                      <td>R$ {{number_format($fluxomovimentacao['entradas'], '2', ',', '.')}}</td>
                    </tr>
                    <tr>
                      <th><a href="{{route('movimentacao.pagamentos.dia')}}">Pagamentos (B):</a><br>
                        <span style="font-weight: 400">Para Fornecedores / Avulso</span>
                      </th>
                      <td>R$ {{number_format($fluxomovimentacao['saidas'], '2', ',', '.')}}</td>
                    </tr>
                    <tr>
                      <th>Total (C) = (A) - (B): <br>
                        <span style="font-weight: 400">Total Entradas - Saídas</span>
                      </th>
                      <td>R$ {{number_format($fluxomovimentacao['fluxodia'], '2', ',', '.')}}</td>
                    </tr>
                    <tr>
                      <th class="th-50">Total do Caixa: <br>
                        <span style="font-weight: 400">Resultado (C) + Caixa Geral</span>
                      </th>
                      <td>R$ {{number_format($fluxomovimentacao['fluxodia'] + array_sum($totais), '2', ',', '.')}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <button class="btn btn-button bg-success w-100 py-3" data-target="#movimentacaoreforco" data-toggle="modal" data-toggle="tt" data-placement="top" title="Pode ser usado para receber valores avulsos ou adicionar dinheiro em caixa">Reforço <i class="fas fa-donate"></i></button>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-button bg-danger w-100 py-3" data-target="#movimentacaosaida" data-tipo="Saída" data-toggle="modal" data-toggle="tt" data-placement="top" title="Pode ser usado para fazer pagamentos avulsos ou dar baixa de valores do caixa">Saída <i class="fas fa-donate"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- entregadores --}}
        @if($config->controlaentrega == 1)
        <div class="card">
          <div class="card-header py-0" id="entregadores">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#resumoEntregadores" aria-expanded="false" aria-controls="resumoEntregadores">
                Resumo Total dos Entregadores
              </button>
            </h5>
          </div>
          <div id="resumoEntregadores" class="collapse" aria-labelledby="entregadores" data-parent="#accordion">
            <div class="card-body">

              <div class="table-responsive" style="overflow: initial!important;">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th>Entregador</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pedidos as $item)
                    <tr>
                      <td>{{$item->nome}}</td>
                      <td>R$ {{number_format($item->total, 2, ',', '.')}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <small>Somente Pedidos com forma de pagamento diferente de "Conta do Cliente"</small>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
  {{-- modal Reforço--}}
  @include('pages.financeiro.modalReforco')
  {{-- modal Saída--}}
  @include('pages.financeiro.modalSaida')
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
  $(function () {
    $('[data-toggle="tt"]').tooltip()
  })

  $(document).ready(function () {  
    $('.valortotal').mask("#.##0.00", {reverse: true});
    $('.valorrecebido').mask("#.##0.00", {reverse: true});
  });

$('#movimentacaosaida').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var tipo = button.data('tipo');
  var modal = $(this);
  console.log(tipo);
  modal.find('.modal-body #tipo').val(tipo);
});
</script>
@endpush
@endsection
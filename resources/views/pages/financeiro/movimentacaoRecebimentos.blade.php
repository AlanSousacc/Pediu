@extends('layouts.app', [
'namePage' => 'Movimentações',
'class' => 'sidebar-mini',
'activePage' => 'recebimentosgeral',
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
        <div class="card card-nav-tabs card-plain">
          <div class="card-body">
            <div class="tab-content text-center">
              <div class="card-header row">
                <div class="col-md-6">
                  <h4 class="card-title text-left mt-0"> Recebimentos Geral</h4>
                </div>
                <div class="col-md-6 text-right">
                  <a href="{{route('movimentacao.show', 'entrada')}}" class="btn btn-success">Novo Recebimento</a>
                  <a href="{{route('movimentacao.recebimentos.dia')}}">Mostrar Recebimentos do Dia</a>
                </div>
              </div>
              <div class="table-responsive" style="overflow: initial!important;">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th></th>
                      <th>Data do Pedido</th>
                      <th>Status</th>
                      <th>Valor Total</th>
                      <th>Valor Recebido</th>
                      <th>Total Pendente</th>
                      <th class="text-center">Opções</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($movimentacao as $item)
                    <tr data-toggle="collapse" data-target="#movimentacao{{$item->id}}" class="accordion-toggle">
                      <td><i class="fa fa-angle-down pl-4"></i></td>
                      <td>{{$item->created_at->format('d/m/Y H:i:s')}}</td>
                      <td class="text-danger"><i class="ionicons {{$item->status == 0 ? 'ion-ios-close-outline text-danger' : 'ion-android-checkmark-circle text-success'}}"></i></td>
                      <td>R$ {{number_format($item->valortotal, 2, ',', '.')}}</td>
                      <td>R$ {{number_format($item->valorrecebido, 2, ',', '.')}}</td>
                      <td>R$ {{number_format($item->valorpendente, 2, ',', '.')}}</td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Ação
                          </button>
                          <div class="dropdown-menu">
                            @if ($item->valorpendente != 0)  
                            <a class="dropdown-item" href="{{$item->id}}" data-tipo="Receber Restante" data-valtotal={{$item->valortotal}}
                              data-valorrecebido={{$item->valorrecebido}} data-valorpendente={{$item->valorpendente}}
                              data-movimentacaoid={{$item->id}} data-target="#pagar" data-toggle="modal">
                              <i class="ionicons ion-cash"></i> Receber Restante
                            </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('detalhe.movimentacao', $item->id) }}"><i class="ionicons ion-ios-paper-outline"></i> Detalhar Movimentação</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="7" class="hiddenRow p-0">
                        <div id="movimentacao{{$item->id}}" class="accordian-body collapse">
                          <table class="table table-bordered mb-0">
                            <thead>
                              <tr>
                                <th class="text-center" style="font-size: 15px; font-weight: 500">Tipo</th>
                                <th class="text-center" style="font-size: 15px; font-weight: 500">Forma Movimentação
                                </th>
                                <th class="text-center" style="font-size: 15px; font-weight: 500">Total</th>
                                <th class="text-center" style="font-size: 15px; font-weight: 500">Recebido</th>
                                <th class="text-center" style="font-size: 15px; font-weight: 500">Data Recebimento
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($fluxomovi->where('movimentacao_id', $item->id) as $fluxo)
                              <tr>
                                <td class="text-center">{{$fluxo->tipo}}</td>
                                <td class="text-center">{{$fluxo->forma_movimentacao}}</td>
                                <td class="text-center">R$ {{number_format($fluxo->valortotal, 2, ',', '.')}}</td>
                                <td class="text-center">R$ {{number_format($fluxo->valor, 2, ',', '.')}}</td>
                                <td class="text-center">{{$fluxo->created_at->format('d/m/Y H:i:s')}}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-md-10 text-left">
                  <p>Mostrando {{$movimentacao->count()}} recebimentos de um total de: {{$movimentacao->total()}}</p>
                </div>
                <div class="col-md-2">{{$movimentacao->links()}}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- modal mudar status--}}
  @include('pages.financeiro.modalReceberPagar')
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='{{asset('js/financeiro/financeiro.js')}}'></script>
@endpush
@endsection
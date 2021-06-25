@extends('layouts.app', [
'namePage' => 'Financeiro do Contatos',
'class' => 'sidebar-mini',
'activePage' => 'listagemfinanceirocontato',
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
          <div class="card-header card-header-warning">
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">
                  <li class="nav-item">
                    <a class="nav-link active" href="#valoresAbertos" data-toggle="tab">Em Aberto</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#valoresPagos" data-toggle="tab">Pagos</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content text-center">
              {{-- tab financeiro em aberto --}}
              <div class="tab-pane active" id="valoresAbertos">
                <div class="card-header">
                  <h4 class="card-title text-left"> Movimentações Abertas do Contato: {{$contato->nome}}</h4>
                </div>
                <div class="table-responsive" style="overflow: initial!important;">
                  <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th></th>
                        <th>Data do Pedido</th>
                        <th>Status</th>
                        <th>Valor Total</th>
                        <th>Restante</th>
                        <th class="text-center">Opções</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($movimentacao->where('status', 0)->where('contato_id', $contato->id) as $item)
                      <tr data-toggle="collapse" data-target="#movimentacao{{$item->id}}" class="accordion-toggle">
                        <td><i class="fa fa-angle-down pl-4"></i></td>
                        <td>{{$item->created_at->format('d/m/Y H:i:s')}}</td>
                        <td class="text-danger"><i class="ion-ios-close-outline text-danger"></i></td>
                        <td>R$ {{number_format($item->valortotal, 2, ',', '.')}}</td>
                        <td>R$ {{number_format($item->valorpendente, 2, ',', '.')}}</td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">
                              Ação
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{$item->id}}" data-valtotal={{$item->valortotal}}
                                data-valorrecebido={{$item->valorrecebido}} data-valorpendente={{$item->valorpendente}}
                                data-movimentacaoid={{$item->id}} data-target="#receber" data-toggle="modal"><i
                                class="ionicons ion-cash"></i> Receber</a>
                                @if ($item->pedido_id != null) 
                                <a class="dropdown-item" href="{{ route('pedido.detalhe', $item->pedido_id) }}"><i
                                  class="ionicons ion-ios-paper-outline"></i> Detalhar Pedido</a>
                                @endif
                              <a class="dropdown-item" href="{{ route('pedido.detalhe', $item->pedido_id) }}"><i
                                class="ionicons ion-ios-paper-outline"></i> Detalhar Movimentação</a>
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
                    <p>Mostrando {{$movimentacao->count()}} movimentações em abertas de um total de
                      {{$movimentacao->total()}}</p>
                  </div>
                  <div class="col-md-2">{{$movimentacao->links()}}</div>
                </div>
              </div>
              {{-- end tab financeiro em aberto --}}

              {{-- tab financeiro fechados --}}
              <div class="tab-pane" id="valoresPagos">
                <div class="card-header">
                  <h4 class="card-title text-left"> Movimentações Pagas do Contato</h4>
                </div>
                <div class="table-responsive" style="overflow: initial!important;">
                  <table class="table">
                    <thead class=" text-primary">
                      <th class="text-center">#ID</th>
                      <th class="text-center">Data do Pedido</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Valor Total</th>
                      <th class="text-center">Recebido</th>
                      <th class="text-center">Opções</th>
                    </thead>
                    <tbody>
                      @foreach ($movimentacao->where('status', 1)->where('contato_id', $contato->id) as $item)
                      <tr data-toggle="collapse" data-target="#movimentacao{{$item->id}}" class="accordion-toggle">
                        <td><i class="fa fa-angle-down pl-4"></i></td>
                        <td>{{$item->created_at->format('d/m/Y H:i:s')}}</td>
                        <td class="text-center text-success"><i class="ion-android-checkmark-circle text-success"></i></td>
                        <td>R$ {{number_format($item->valortotal, 2, ',', '.')}}</td>
                        <td>R$ {{number_format($item->valorrecebido, 2, ',', '.')}}</td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false"> Ação</button>
                            <div class="dropdown-menu">
                              @if ($item->pedido_id != null) 
                                <a class="dropdown-item" href="{{ route('pedido.detalhe', $item->pedido_id) }}"><i
                                  class="ionicons ion-ios-paper-outline"></i> Detalhar Pedido</a>
                                @endif
                              <a class="dropdown-item" href="{{ route('pedido.detalhe', $item->pedido_id) }}"><i
                                class="ionicons ion-ios-paper-outline"></i> Detalhar Movimentação</a>
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
                    <p>Mostrando {{$movimentacao->where('status', 1)->where('contato_id', $contato->id)->count()}}
                      movimentações encerradas de um total de {{$movimentacao->total()}}</p>
                  </div>
                  <div class="col-md-2">{{$movimentacao->links()}}</div>
                </div>
              </div>
              {{-- endtab financeiro fechado --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- modal mudar status--}}
  @include('pages.contatos.modalReceber')
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='{{asset('js/contato/contato.js')}}'></script>
@endpush
@endsection
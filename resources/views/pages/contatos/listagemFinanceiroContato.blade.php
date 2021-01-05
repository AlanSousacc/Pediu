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
            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
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
                  <h4 class="card-title text-left"> Movimentações em Abertas do Contato</h4>
                </div>
                <div class="table-responsive" style="overflow: initial!important;">
                  <table class="table">
                    <thead class=" text-primary">
                      <th class="text-center">#ID</th>
                      <th class="text-center">Data do Pedido</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Valor Total</th>
                      <th class="text-center">Recebido</th>
                      <th class="text-center">Restante</th>
                      <th class="text-center">Opções</th>
                    </thead>
                    <tbody>
                      @foreach ($movimentacao->where('status', 0)->where('contato_id', $contato->id) as $item)
                      <tr>
                        <td class="text-center">{{$item->id}}</td>
                        <td class="text-center">{{$item->created_at->format('d/m/Y H:i:s')}}</td>
                        <td class="text-center text-danger"><i class="ionicons ion-close-circled"></i></td>
                        <td class="text-center">R$ {{number_format($item->valortotal, 2, ',', '.')}}</td>
                        <td class="text-center">R$ {{number_format($item->valorrecebido, 2, ',', '.')}}</td>
                        <td class="text-center">R$ {{number_format($item->valorpendente, 2, ',', '.')}}</td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item"
                                href="{{$item->id}}"
                                data-valtotal={{$item->valortotal}} 
                                data-valorrecebido={{$item->valorrecebido}} 
                                data-valorpendente={{$item->valorpendente}} 
                                data-movimentacaoid={{$item->id}} 
                                data-target="#receber" 
                                data-toggle="modal"><i class="ionicons ion-cash"></i> Receber</a>
                              <a class="dropdown-item" href="{{ route('pedido.detalhe', $item->pedido_id) }}"><i class="ionicons ion-ios-paper-outline"></i> Detalhar</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="row">
                  <div class="col-md-10 text-left"><p>Mostrando {{$movimentacao->count()}} movimentações em abertas de um total de {{$movimentacao->total()}}</p></div>
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
                      <tr>
                        <td class="text-center">{{$item->id}}</td>
                        <td class="text-center">{{$item->created_at->format('d/m/Y H:i:s')}}</td>
                        <td class="text-center text-success"><i class="ionicons ion-checkmark-circled"></i></td>
                        <td class="text-center">R$ {{number_format($item->valortotal, 2, ',', '.')}}</td>
                        <td class="text-center">R$ {{number_format($item->valorrecebido, 2, ',', '.')}}</td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('pedido.detalhe', $item->pedido_id)}}"><i class="ionicons ion-ios-paper-outline"></i> Detalhar</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="row">
                  <div class="col-md-10 text-left"><p>Mostrando {{$movimentacao->where('status', 1)->where('contato_id', $contato->id)->count()}} movimentações encerradas de um total de {{$movimentacao->total()}}</p></div>
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
@extends('layouts.app', [
'namePage' => 'Detalhes do pedido',
'class' => 'sidebar-mini',
'activePage' => 'detalhefinanceiro',
])
@section('content')
<div class="col-md-3 offset-md-9 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>

<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row" >
    <div class="col-md-10 offset-1">
      <div class="card">
        <div class="card-header">
          <h5 class="title">{{__("Detalhes da Movimentação Financeira")}}</h5>
        </div>
        <div class="card-body details">
          <div class="card card-nav-tabs card-plain">
            <div class="card-header card-header-primary">
              <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#detalhemovimentacao" data-toggle="tab">Detalhes da Movimentação</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#detalhesfluxo" data-toggle="tab">Registro de Movimentações</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body ">
              <div class="tab-content">
                {{-- Detalhes Pedido --}}
                <div class="tab-pane active" id="detalhemovimentacao">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="col ml-2">#ID</label>
                        <input type="text" disabled class="form-control text-center" value="{{isset($movimentacao) ? $movimentacao->id : ''}}" >
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="col ml-2">Data e Hora</label>
                        <input type="text" disabled class="form-control"value="{{isset($movimentacao) ? $movimentacao->created_at->format('d/m/Y H:i:s') : ''}}">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col ml-2">Status da Movimentação</label>
                        @if ($movimentacao->status == 0)
                        <input type="text" class="form-control text-warning" value="Em Aberto">
                        @else
                        <input type="text" class="form-control text-warning" value="Finalizado">
                        @endif
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="col ml-2">Pedido</label>
                        @if ($movimentacao->pedido_id != null)
                        <a href="{{route('pedido.detalhe', $movimentacao->pedido_id)}}">#ID {{$movimentacao->pedido_id}}</a>
                        @else
                        <input type="text" disabled class="form-control" value="Nenhum Pedido" >
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col ml-2">Tipo</label>
                        <input type="text" disabled class="form-control text-center" value="{{$movimentacao->tipo}}" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label class="col ml-2">Nome do Contato</label>
                        <input type="text" disabled class="form-control" value="{{$movimentacao->contato != null ? $movimentacao->contato->nome : 'Nenhum Contato - AVULSO'}}" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col ml-2">Forma de Pagamento</label>
                        <input type="text" disabled class="form-control" value="{{isset($movimentacao) ? $movimentacao->forma_pagamento : ''}}" >
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label class="col ml-2">Total</label>
                      <div class="input-group col">
                        <div class="input-group-prepend">
                          <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" disabled class="form-control text-center" value="{{number_format($movimentacao->valortotal, 2, ',', '.')}}">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label class="col ml-2">Valor Recebido</label>
                      <div class="input-group col">
                        <div class="input-group-prepend">
                          <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" disabled class="form-control text-center" value="{{number_format($movimentacao->valorrecebido, 2, ',', '.')}}">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label class="col ml-2">Valor Pendente</label>
                      <div class="input-group col">
                        <div class="input-group-prepend">
                          <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" disabled class="form-control text-center" value="{{number_format($movimentacao->valorpendente, 2, ',', '.')}}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="col ml-2">Observação</label>
                        <input type="text" disabled class="form-control" value="{{isset($movimentacao) ? $movimentacao->observacao : ''}}" >
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="detalhesfluxo">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive" style="overflow: initial!important;">
                        <table class="table">
                          <thead class=" text-primary">
                            <th class="text-center">Tipo de Movimentação</th>
                            <th class="text-center">{{$movimentacao->tipo == 'Saída' ? 'Forma de Pagamento' : 'Forma de Recebimento'}}</th>
                            <th class="text-center">Vlr. Total</th>
                            <th class="text-center">{{$movimentacao->tipo == 'Saída' ? 'Vlr. Pago' : 'Vlr. Recebido'}}</th>
                            <th class="text-center">Data</th>
                          </thead>
                          <tbody>
                            @foreach ($fluxomovi as $item)
                            <tr>
                              <td class="text-center">{{$item->tipo}}</td>
                              <td class="text-center">{{$item->forma_movimentacao}}
                              <td class="text-center">R$ {{number_format($item->valortotal, '2', ',', '.')}}
                              <td class="text-center">R$ {{number_format($item->valor, '2', ',', '.')}}
                              <td class="text-center">{{$item->created_at->format('d/m/Y H:i:s')}}
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@endpush
@endsection

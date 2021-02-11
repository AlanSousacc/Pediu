@extends('layouts.app', [
'namePage' => 'Detalhes do pedido',
'class' => 'sidebar-mini',
'activePage' => 'detalhepedido',
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
          <h5 class="title">{{__("Detalhes do Pedido")}}</h5>
        </div>
        <div class="card-body details">
          <div class="card card-nav-tabs card-plain">
            <div class="card-header card-header-primary">
              <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#detalhePedido" data-toggle="tab">Detalhes Pedido</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#itensPedido" data-toggle="tab">Itens do Pedido</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#detalhesPagamento" data-toggle="tab">Detalhes do Pagamento</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body ">
              <div class="tab-content">
                {{-- Detalhes Pedido --}}
                <div class="tab-pane active" id="detalhePedido">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="col ml-2">#ID</label>
                        <input type="text" disabled class="form-control text-center" value="{{isset($pedido) ? $pedido->id : ''}}" >
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col ml-2">Data e Hora</label>
                        <input type="text" disabled class="form-control"value="{{isset($pedido) ? $pedido->created_at->format('d/m/Y H:i:s') : ''}}">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col ml-2">Status do Pedido</label>
                        @if ($pedido->statusentrega == 0)
                        <input type="text" class="form-control text-warning" value="Pedido Processado">
                        @endif
                      </div>
                    </div>
                  </div>

                  {{-- detalhes do contato --}}
                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label class="col ml-2">Nome Completo</label>
                        <input type="text" disabled class="form-control" value="{{isset($pedido) ? $pedido->contato->nome : ''}}" >
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col ml-2">Telefone</label>
                        <input type="text" disabled class="form-control" value="{{isset($pedido) ? $pedido->contato->telefone : ''}}" >
                      </div>
                    </div>
                  </div>
                  {{-- end detalhes contato --}}

                  {{-- detalhes entrega --}}
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col ml-2">Endereço</label>
                        <input type="text" disabled class="form-control" value="{{isset($pedido) ? $pedido->endereco->endereco : ''}}" >
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="col ml-2">Número</label>
                        <input type="text" disabled class="form-control"ora" value="{{isset($pedido) ? $pedido->endereco->numero : ''}}" >
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col ml-2">Bairro</label>
                        <input type="text" disabled class="form-control" value="{{isset($pedido) ? $pedido->endereco->bairro : ''}}" >
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col ml-2 text-left">Cidade</label>
                        <input type="text" disabled class="form-control" value="{{isset($pedido) ? $pedido->endereco->cidade : ''}}" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="col ml-2">Observação</label>
                        <input type="text" disabled class="form-control" value="{{isset($pedido) ? $pedido->endereco->observacao : ''}}" >
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end detalhes entrega --}}

                {{-- Itens do Pedido --}}
                <div class="tab-pane" id="itensPedido">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive" style="overflow: initial!important;">
                        <table class="table">
                          <thead class=" text-primary">
                            <th class="text-center">#ID</th>
                            <th class="text-center">Descrição</th>
                            <th class="text-center">Qtde</th>
                            <th class="text-center">Vlr. Unitário</th>
                            <th class="text-center">Vlr. Total</th>
                          </thead>
                          <tbody>
                            @foreach ($pedido->produtos as $item)
                            <tr>
                              <td class="text-center">{{$item->id}}</td>
                              <td class="text-center">{{$item->descricao}}
                                @if ($item->pivot->obsitem != null)
                                <br><small class="obs-item">{{$item->pivot->obsitem}}</small></td>
                                @endif
                              </td>
                              <td class="text-center">{{$item->pivot->qtde}}</td>
                              <td class="text-center">R$ {{number_format($item->pivot->prvenda, 2, ',', '.')}}</td>
                              <td class="text-center">R$ {{number_format($item->pivot->prvenda * $item->pivot->qtde, 2, ',', '.')}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                {{-- Detalhes do Pagamento --}}
                <div class="tab-pane" id="detalhesPagamento">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col ml-2">Forma de Pagamento</label>
                        <input type="text" disabled class="form-control" value="{{isset($pedido) ? $pedido->forma_pagamento : ''}}" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <label class="col ml-2">Desconto</label>
                      <div class="input-group col">
                        <div class="input-group-prepend">
                          <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" disabled class="form-control text-center" value="{{number_format(isset($pedido) ? $pedido->desconto : '', 2, ',', '.')}}">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <label class="col ml-2">Sub Total</label>
                      <div class="input-group col">
                        <div class="input-group-prepend">
                          <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" disabled class="form-control text-center" value="{{number_format(isset($pedido) ? $pedido->total : '', 2, ',', '.')}}">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <label class="col ml-2">Levar Troco</label>
                      <div class="input-group col">
                        <div class="input-group-prepend">
                          <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" disabled class="form-control text-center" value="{{number_format(isset($pedido) ? $pedido->valortroco : '', 2, ',', '.')}}">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <label class="col ml-2">Total</label>
                      <div class="input-group col">
                        <div class="input-group-prepend">
                          <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" disabled class="form-control text-center" value="{{number_format(isset($pedido) ? $pedido->total - $pedido->desconto : '', 2, ',', '.')}}">
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
        <div class="card-footer text-right">
          <a href="{{route('imprimir.pedido', $pedido->id)}}" target="_blank" class="btn btn-success btn-round"><i class="ionicons ion-printer"></i> Imprimir Pedido</a>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='{{asset('js/pedidos/pedidos.js')}}'></script>
@endpush
@endsection

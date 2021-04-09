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
                        <input type="text" disabled class="form-control text-center" value="{{isset($pedido) ? $pedido->numberorder : ''}}" >
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col ml-2">Data e Hora</label>
                        <input type="text" disabled class="form-control"value="{{isset($pedido) ? $pedido->created_at->format('d/m/Y H:i:s') : ''}}">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group w-100">
                        <label class="col text-center">Status do Pedido</label>
                        @if ($pedido->statuspedido == 0)
                        <span class="text-light w-100 d-block text-center bg-warning p-1 rounded">Pendente</span>
                        @elseif($pedido->statuspedido == 1)
                        <span class="text-light w-100 d-block text-center bg-info p-1 rounded">Aprovado</span>
                        @elseif($pedido->statuspedido == 2)
                        <span class="text-light w-100 d-block text-center bg-secondary p-1 rounded">Preparando</span>
                        @elseif($pedido->statuspedido == 3)
                        <span class="text-light w-100 d-block text-center bg-dark p-1 rounded">Saiu para Entrega</span>
                        @elseif($pedido->statuspedido == 4)
                        <span class="text-light w-100 d-block text-center bg-success p-1 rounded">Entregue</span>
                        @elseif($pedido->statuspedido == 5)
                        <span class="text-light w-100 d-block text-center bg-danger p-1 rounded">Cancelado</span>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{-- detalhes do contato --}}
                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label class="col ml-2">Nome Completo</label>
                        <input type="text" disabled class="form-control" value="{{isset($pedido) ? $pedido->user->name : ''}}" >
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col ml-2">Telefone</label>
                        <input type="text" disabled class="form-control" value="{{isset($pedido) ? $pedido->endereco->telefone : ''}}" >
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
                        <input type="text" disabled class="form-control" value="{{isset($pedido) ? $pedido->observacao : ''}}" >
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
                          <thead class="text-primary">
                            <th class="text-center">#ID</th>
                            <th class="text-center">Descrição</th>
                            <th class="text-center">Obs.</th>
                            <th class="text-center">Adicionais</th>
                            <th class="text-center">Sabores</th>
                            <th class="text-center">Qtde</th>
                            <th class="text-center">R$ Unit.</th>
                            <th class="text-center">R$ Total</th>
                          </thead>
                          <tbody>
                            @foreach ($pedido->orderitems as $item)
                            <tr style="font-size: 16px;">
                              <td class="text-center">{{$item->produtos->id}}</td>
                              <td class="text-center">{{$item->produtos->descricao}}</td>
                              <td class="text-center">{{$item->observacaoitem}}</td>
                              <td class="text-center">
                                @foreach ($pedido->complementositemcart as $adicionais)
                                  @if($adicionais->cartitems_id == $item->id)
                                  <span class="bg-primary text-white p-1 rounded"> {{$adicionais->complemento->descricao}}</span>
                                  @endif
                                @endforeach
                              </td>
                              <td class="text-center">
                                @foreach ($pedido->meioameioitemcart as $meioameio)
                                  @if($meioameio->cartitems_id == $item->id)
                                  <span class="px-1">{{$meioameio->produtos->descricao}}; </span>
                                  @endif
                                @endforeach
                              </td>
                              <td class="text-center">{{$item->qtde}}</td>
                              <td class="text-center">R$ {{number_format($item->preco, 2, ',', '.')}}</td>
                              <td class="text-center">R$ {{number_format($item->preco * $item->qtde, 2, ',', '.')}}</td>
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
                        <input type="text" disabled class="form-control" value="{{isset($pedido) ? $pedido->formapagamento : ''}}" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <label class="col ml-2">Valor de Entrega</label>
                      <div class="input-group col">
                        <div class="input-group-prepend">
                          <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" disabled class="form-control text-center" value="{{number_format(isset($pedido) ? $pedido->valorentrega : '', 2, ',', '.')}}">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <label class="col ml-2">Sub Total</label>
                      <div class="input-group col">
                        <div class="input-group-prepend">
                          <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" disabled class="form-control text-center" value="{{number_format(isset($pedido) ? $pedido->subtotalpedido : '', 2, ',', '.')}}">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <label class="col ml-2">Troco Para:</label>
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
                        <input type="text" disabled class="form-control text-center" value="{{number_format(isset($pedido) ? $pedido->totalpedido : '', 2, ',', '.')}}">
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
        <div class="card-footer text-right">
          <a href="{{route('imprimir.pedidoloja', $pedido->id)}}" target="_blank" class="btn btn-success btn-round"><i class="ionicons ion-printer"></i> Imprimir Pedido</a>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@endpush
@endsection

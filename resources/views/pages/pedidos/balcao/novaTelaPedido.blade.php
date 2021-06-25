@extends('layouts.app', [
'namePage' => 'novo pedido',
'class' => 'sidebar-mini',
'activePage' => 'novopedido',
])
@section('content')
<div class="col-md-3 offset-md-9 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>

<div class="panel-header panel-header-sm">
</div>
@push('scripts')
{{-- verifica se o pedido foi concluído com sucesso e abre o modal --}}
@if(session('pedido'))
<script>
  $(function() {
    $('#impressao').modal('show');
  });
</script>
@endif
@endpush

<div id="app">
  <div class="content">
    <!-- MultiStep Form -->
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-sm-11 col-md-11 col-lg-11 p-0 mb-2" style="margin-top: -30px;">
          <div class="card px-0 pt-2 pb-0 mb-3">
            {{-- <h4 class="card-title text-left mt-1 pl-2">NOVO PEDIDO</h4>  --}}
            {{-- <p>Siga os passos abaixo para gerar um novo pedido</p> --}}
            <div class="row">
              <div class="col-md-12 mx-0">
                <input type="hidden" value="{{$id ?? null}}" id="editId">
                <form id="msform">
                  <ul class="p-0" id="progressbar">
                    <li class="active" id="cliente"><strong>Cliente</strong></li>
                    <li id="cardapio"><strong>Cardápio</strong></li>
                    <li id="entrega"><strong>Entrega</strong></li>
                    <li id="pagamento"><strong>Pagamento</strong></li>
                    {{-- <li id="confirm"><strong>Concluído</strong></li> --}}
                  </ul>

                  {{-- steep de Cliente --}}
                  <fieldset>
                    <div class="px-4">
                      <h4 class="text-center mt-1">ESCOLHA UM CLIENTE</h4>
                    </div>
                    <div class="row w-100 m-0 py-4" style="background: #f7f7f9; font-size: 20px;">
                      <div class="col-md-10">
                        <div class="form-group lista-clientes">
                          <label class="col-md-12 control-label text-left text-dark">PESQUISE O CLIENTE PELO NOME OU TELEFONE</label>
                          <div class="col-md-12">
                            <vue-search-select :options="listagemContatos.map((contato) => { return {text: contato.nome + ' ' + contato.telefone, value: contato.id, ...contato}})" v-model="contato" placeholder="Escolha um Cliente"></vue-search-select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 mt-4 text-left">
                        <button type="button" :disabled="contatoId" class="btn btn-info mt-3 btn-sm novo-cliente" v-on:click="showformcliente = !showformcliente" style="margin-top: 15px;"><i class="now-ui-icons ui-1_simple-add"></i> Novo Cliente</button>
                      </div>
                    </div>
                    
                    <div class="card-body formulario-cliente" v-if="showformcliente" style="font-size: 14px;">
                      <div class="row mt-4">
                        <div class="form-group col-md-12">
                          <h4 class="text-center mt-1">Dados do Cliente</h4>
                          @include('pages.contatos.formContato')
                        </div>
                        <div class="col-md-12">
                          <h4 class="text-center mt-1">Endereço de Entrega</h4>
                          @include('pages.enderecos.formEndereco')
                        </div>
                      </div>
                    </div>
                    <button
                      type="button"
                      :disabled="!contato && (!novocliente.nome || !novocliente.telefone || !novocliente.endereco || !novocliente.numero || !novocliente.bairro || !novocliente.cidade)"
                      class="btn btn-info btn-round next position-sticky"
                      style="bottom: 30px"
                      name="next">ESCOLHER PRODUTOS <i class="fa fa-arrow-circle-right"></i>
                    </button>
                  </fieldset>
                  {{-- End Cliente --}}

                  {{-- steep de cardápio --}}
                  <fieldset>
                    <div class="px-4">
                      <h4 class="text-center mt-1">Montar Cardápio</h4>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="row w-100 m-0 py-2">
                          <div class="col-md-12">
                            <div class="form-group">
                              <input type="search" class="w-100 mt-1 form-control consultaitem" v-model="search" @input="consultaItem" placeholder="Procurar item pelo nome [SHIFT + ENTER]" autofocus>
                            </div>
                          </div>
                        </div>

                        <div class="row text-left m-0">
                          <div class="col-md-12">
                            <h5 class="card-title text-left mt-1 pl-2">Grupos</h5>
                            <ul style="display: inline-block; overflow: auto; overflow-y: hidden; max-width: 100%; margin: 0 0 1em; white-space: nowrap;">
                              @foreach ($grupos as $item)
                              <li class="nav-item text-center" style="display: inline-block; vertical-align: top;">
                                <a class="nav-link active" href="#" v-on:click.prevent="getItemsGroup({{$item->id}})">
                                <img src="{{url("storage/" .$item->image)}}" alt="{{ $item->empresa->razao}}" style="height: 60px; width: 60px; border-radius: 100px; padding: 5px;"/> <br>
                                {{$item->descricao}}
                                </a>
                              </li>
                              @endforeach
                            </ul>
                          </div>
                          {{-- @{{groupid}} --}}
                        </div>

                        <div class="row text-left m-0">
                          <div class="col-md-12">
                            <h5 class="card-title text-left mt-1 pl-2">Listagem de Itens</h5>
                            <div class="table-responsive table-wrapper">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center">Descriçao</th>
                                    <th class="text-center">Pr. Pequeno</th>
                                    <th class="text-center">Pr. Medio</th>
                                    <th class="text-center">Pr. Grande</th>
                                    <th class="text-center">Lançar</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="item in items">
                                    <td class="text-center">@{{item.descricao}}</td>
                                    <td class="text-center">@{{item.precopequeno | currency}}</td>
                                    <td class="text-center">@{{item.precovenda | currency}}</td>
                                    <td class="text-center">@{{item.precogrande | currency}}</td>
                                    <td class="text-center">
                                      <a :href="item.id" v-on:click.prevent="openModalItem(item.id)" data-toggle="modal" data-target="#myModal" class="p-4"><i class="fa fa-arrow-circle-right text-success"></i></a>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            {{-- <button type="button" >Launch modal</button> --}}
                          </div>
                        </div>

                      </div>
                      {{-- coluna de itens no pedido --}}
                      <div class="col-md-6">
                        <div class="row text-left m-0">
                          <div class="col-md-12">
                            <div class="table-responsive">
                              <table class="table table-sm">
                                <thead>
                                  <tr>
                                    <th class="text-left">Item</th>
                                    <th class="text-center">Qtde</th>
                                    <th class="text-center">Valor Un.</th>
                                    <th class="text-center">Valor Total</th>
                                    <th class="text-center"><i class="fa fa-ellipsis-h"></i></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="itempedido in itemsPedido">
                                    <td class="text-left">@{{itempedido.descricaoItem}}
                                      <template v-if="itempedido.observacao">
                                        <br><small>Obs: </small><small class="">@{{itempedido.observacao}}</small>
                                      </template>
                                      <template  v-if="itempedido.adicional && itempedido.adicional.length > 0">
                                        <br><small class="bg-info p-1 mr-1 mb-1 d-inline-block text-white" v-for="adicional in itempedido.adicional">Adicional: @{{adicional.descricao}} </small>
                                      </template>
                                      <template  v-if="itempedido.sabores && itempedido.sabores.length > 0">
                                        <br><small>Meio: </small><small class="bg-warning p-1 mr-1 text-white" v-for="sabor in itempedido.sabores">@{{sabor.descricao}} </small>
                                      </template>
                                    </td>
                                    <td class="text-center">@{{itempedido.qtde}}</td>
                                    <td class="text-center">@{{itempedido.preco | currency}}</td>
                                    <td class="text-center">@{{itempedido.totalItemLista | currency}}</td>
                                    <td class="text-center">
                                      <a class="m-1" href="#" @click="removeItem(itempedido.iditemlista)"><i class="fa fa-times-circle text-danger"></i></a>
                                      <a class="m-1" href="#" v-on:click.prevent="openModalItem(itempedido.iditem, itempedido)" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit text-info"></i></a>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="row w-100 totais">
                            <div class="col-md-6 p-2 text-center border border-light bg-light">
                              <span>Qtde Itens</span><br>
                              <span>@{{totalItemsPedido}} Unid.</span>
                            </div>
                            <div class="col-md-6 p-2 text-center border border-light bg-light">
                              <span>Total</span><br>
                              <span><small>R$</small> @{{Number(totalMonetarioPedido).toFixed(2)}}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- end coluna itens no pedido --}}
                    </div>

                    <button type="button" class="btn btn-warning btn-round previous position-sticky" style="bottom: 30px" name="previous"><i class="fa fa-arrow-circle-left"></i> VOLTAR AO CLIENTE</button>
                    <button type="button" :disabled="itemsPedido && itemsPedido.length == 0" class="btn btn-info btn-round next position-sticky" style="bottom: 30px" name="next">LOCAL DE ENTREGA <i class="fa fa-arrow-circle-right"></i></button>
                  </fieldset>
                  {{-- End cardápio --}}

                  {{-- steep de entrega --}}
                  <fieldset>
                    <div class="px-4">
                      <h4 class="text-center mt-1">Onde Entregaremos o Pedido</h4>
                    </div>
                    
                    <div class="alert alert-warning" role="alert" v-if="enderecosContato && enderecosContato.length == 0">
                      Cliente não informado, ou cliente sem endereço de entrega cadastrado
                    </div>
                    <div class="row w-100 m-0 py-4" style="background: #f7f7f9;">
                      <div class="col-md-10" v-if="enderecosContato && enderecosContato.length != 0">
                        <div class="form-group">
                          <label class="col-md-12 control-label text-left text-dark">SELECIONE O ENDEREÇO NA LISTAGEM ABAIXO</label>
                          <div class="col-md-12">
                            <select v-model="endereco_id" class="form-control w-100 endereco-select">
                              <option :value="endereco.id" v-for="endereco in enderecosContato">@{{'Endereço: '+endereco.endereco+ ' ; Nº ' +endereco.numero+ ' ; Bairro: ' +endereco.bairro}}</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col mt-3 text-center">
                        <button type="button" class="btn btn-info" v-on:click="novoenderecoentrega = !novoenderecoentrega"><i class="fa fa-map-marked-alt"></i> Novo Endereço</button>
                      </div>
                    </div>
                    <div class="col-md-12 mb-4">
                      <div class="col-md-12" v-if="showformcliente || novoenderecoentrega">
                        <h4 class="text-center mt-1">Cadastrar Novo Endereço</h4>
                        @include('pages.enderecos.formEndereco')
                      </div>
                    </div>
                      <button type="button" class="btn btn-warning btn-round previous position-sticky" style="bottom: 30px" name="previous"><i class="fa fa-arrow-circle-left"></i> VOLTAR AO CARDÁPIO</button>
                      <button type="button" :disabled="!endereco_id && (!novocliente.endereco || !novocliente.numero || !novocliente.bairro || !novocliente.cidade)" class="btn btn-info btn-round next position-sticky" style="bottom: 30px" name="next">FORMA DE PAGAMENTO <i class="fa fa-arrow-circle-right"></i></button>
                  </fieldset>
                  {{-- End entrega --}}

                  {{-- steep de pagamento --}}
                  <fieldset>
                    <div class="px-4">
                      <h4 class="text-center mt-1">Sobre o Pagamento</h4>
                    </div>

                    <div class="row w-100 m-0 py-4">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-md-12 control-label text-left">COMO O CLIENTE VAI PAGAR</label>
                          <div class="col-md-12">
                            <select v-model="pagamento.forma_pagamento" class="form-control" required>
                              <option selected value="Dinheiro">Dinheiro</option>
                              <option value="Cartão de Crédito">Cartão de Crédito</option>
                              <option value="Cartão de Débito">Cartão de Débito</option>
                              <option value="Conta do Cliente">Conta do Cliente</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <label class="col-md-12 control-label ml-2">LOCAL DE PAGAMENTO</label>
                        <div class="col-md-12">
                          <select v-model="pagamento.local_pagamento" class="form-control" required>
                            <option selected value="Local de Entrega">Local de Entrega</option>
                            <option value="Balcao">Balcão</option>
                            <option value="Mesa">Mesa</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row w-100 m-0 py-4">
                      <div class="form-group col-md-3">
                        <label for="troco" class="col ml-2">LEVAR TROCO PARA</label>
                        <div class="input-group col">
                          <div class="input-group-prepend">
                            <span class="input-group-text sifra-troco">R$</span>
                          </div>
                          <input type="text" v-model.lazy="pagamento.valortroco" v-money="money" class="form-control text-center troco">
                        </div>
                      </div>

                      <div class="form-group col-md-3">
                        <label for="taxaentrega" class="col ml-2">TAXA DE ENTREGA</label>
                        <div class="input-group col">
                          <div class="input-group-prepend">
                            <span class="input-group-text sifra-troco">R$</span>
                          </div>
                          <input type="text" v-model.lazy="pagamento.taxaentrega" v-money="money" class="form-control taxaentrega text-center">
                        </div>
                      </div>

                      <div class="form-group col-md-3">
                        <label for="desconto" class="col ml-2">TEM DESCONTO DE</label>
                        <div class="input-group col">
                          <div class="input-group-prepend">
                            <span class="input-group-text sifra-troco">R$</span>
                          </div>
                          <input type="text" placeholder="0" v-model.lazy="pagamento.desconto" v-money="money" class="form-control desconto text-center" id="desconto">
                        </div>
                      </div>

                      <div class="form-group col-md-3">
                        <label for="total" class="col ml-3">TOTAL A PAGAR</label>
                        <div class="input-group col">
                          <div class="input-group-prepend">
                            <span class="input-group-text sifra">R$</span>
                          </div>
                          <input type="text" readonly :value="calculaPedido" class="form-control text-center">
                        </div>
                      </div>
                    </div>

                    <div class="row w-100 m-0 py-4">
                      <div class="form-group col-md-12 px-4">
                        <div class="form-group">
                          <label for="observacao" class="col ml-1">DESCREVA UMA OBSERVAÇÃO A ESTE PEDIDO</label>
                          <input type="text" v-model="pagamento.observacao" class="form-control" placeholder="Observação do Pedido">
                        </div>
                      </div>
                    </div>

                    <button type="button" class="btn btn-warning btn-round previous position-sticky" style="bottom: 30px" name="previous"> <i class="fa fa-arrow-circle-left"></i> VOLTAR AO PAGAMENTO</button>
                    <button type="button" @click.prevent="concluirPedido()" class="btn btn-success btn-round position-sticky btn-concluir-pedido" style="bottom: 30px" name="next">CONCLUÍR PEDIDO <i class="fa fa-check-circle"></i></button>
                  </fieldset>
                  {{-- End pagamento --}}
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <modal-detalhe-item v-if="showModal" :item="item" :details="details" v-on:cancelar="cancelar()" v-on:details-item="lancarItem($event)"></modal-detalhe-item>
  </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script> --}}
<script src='{{asset('js/pedidos/pedidos.js')}}'></script>
<script src='{{asset('js/vue/app.js')}}' type="module"></script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- preenche os campos do contato ao selecionar --}}
<script>
  $(document).ready(function(){
    $('.my-select').selectpicker();
    $(".novo-cliente").click(function(){
      $('.form-ativo').hide();
      $('.form-tipo').hide();
      $('.form-status').hide();
      $('.form-principal').hide();
      $('.telefone').mask('(00) 00000-0000');
      $('.telefone_entrega').mask('(00) 00000-0000');
      $('#cep').mask('00000-000');
    });
  });

  $('.telefone').mask('(00) 00000-0000');
  $('#cep').mask('00000-000');
  $('#documento').mask('000.000.000-00', {
    reverse: true
  });
</script>
@endpush
@endsection
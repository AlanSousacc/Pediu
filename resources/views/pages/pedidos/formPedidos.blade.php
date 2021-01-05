<div class="content">
  {{-- cliente e entrega --}}
  <div class="row">
    <div class="form-group col-md-4">
      <label class="col-md-12 control-label ml-2" for="contatoid">Clientes Ativos*</label>
      <div class="col-md-12">
        <select id="contatoid" name="contato_id" class="form-control js-example-basic-single" required>
          @foreach($contatos->where('ativo', 1) as $item)
          <option value="{{$item->id}}" {{isset($pedido) && $item->id == $pedido->contato->id ? 'selected' : ''}}>{{$item->nome}} - {{$item->telefone}}</option>
          @endforeach
        </select>
      </div>
    </div>


    <div class="btn-group col-md-1 mt-3 add" role="group" aria-label="Basic example">
      <a href="{{route('contato.create')}}" class="btn btn-primary"><i class="now-ui-icons ui-1_simple-add"></i></a>
      <a href="" class="btn btn-primary contato-edit"><i class="ionicons ion-edit"></i></a>
    </div>

    {{-- <div class="form-group col-md-1 mt-2 add">
      <a href="{{route('contato.create')}}" class="btn btn-round btn-sm mt-4 btn-outline-primary"><i class="now-ui-icons ui-1_simple-add"></i></a>
    </div> --}}

    <div class="form-group col-md-6 offset-md-1">
      <label class="col-md-12 control-label ml-2" for="entrega_id">Local de Entrega*</label>
      <div class="col-md-12">
        <select id="entrega_id" name="entrega_id" class="form-control js-example-basic-single" required>
        </select>
      </div>
    </div>
  </div>
  {{-- fim cliente e entrega --}}

  {{-- selecionar produto --}}
  <div class="row">
    <div class="form-group col-md-4">
      <label class="col-md-12 control-label ml-2" for="produto_id">#ID - Nome do Produto</label>
      <div class="col-md-12">
        <select id="produto_id" name="produto_id" class="form-control js-example-basic-single">
          @foreach($produtos as $item)
          <option value="{{ $item->id }}">{!! $item->id !!} - {!! $item->descricao !!}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="col-md-3 pr-3">
      <div class="form-group">
        <label for="obsitem" class="col ml-1">Observação do Produto</label>
        <input type="text" class="form-control" id="obsitem" placeholder="Observação do Item">
      </div>
    </div>

    <div class="col-md-2">
      <label for="prvenda" class="col ml-3">Preço</label>
      <div class="input-group col">
        <div class="input-group-prepend">
          <span class="input-group-text">R$</span>
        </div>
        <input type="text" class="form-control prvenda text-center" id="prvenda">
      </div>
    </div>

    <div class="col-md-2">
      <label for="qtde" class="col ml-3">Qtde</label>
      <div class="input-group col">
        <input type="number" min="1" max="15" class="form-control qtde text-center" value="1" id="qtde">
      </div>
    </div>

    <div class="form-group col-md-1 mt-2 text-center">
      <button type="button" class="btn btn-primary btn-round mt-3" id="inserirProduto" data-type="plus" data-field="quant[1]"><i class="now-ui-icons ui-1_simple-add"></i></button>
    </div>
  </div>
  {{-- fim seleção de produtos --}}

  {{-- listagem dos itens --}}
  <div class="row">
    <div class="col-md-12">
      <div class="card-header">
        <h6 class="card-title">Produtos Selecionados</h6>
      </div>
      <div class="card-body">
        <table class="table">
          <thead class=" text-primary">
            <th class="text-left">Descrição do Produto</th>
            <th class="text-center">Qtde</th>
            <th class="text-center">Preço Unitário</th>
            <th class="text-center">Total</th>
            <th class="text-center">Remover</th>
          </thead>
          <tbody id="listaProd">
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <hr class="divider"><br>
  {{-- fim listagem dos itens --}}

  {{-- forma de pagamento e valor total --}}
  <div class="row">
    <div class="form-group col-md-3">
      <label class="col-md-12 control-label ml-2" for="forma_pagamento">Forma de Pagamento*</label>
      <div class="col-md-12">
        <select id="forma_pagamento" name="forma_pagamento" class="form-control js-example-basic-single" required>
          <option {{isset($pedido) && $pedido->forma_pagamento == 'Dinheiro' ? 'selected' : ''}} value="Dinheiro">Dinheiro</option>
          <option {{isset($pedido) && $pedido->forma_pagamento == 'Cartão de Crédito' ? 'selected' : ''}} value="Cartão de Crédito">Cartão de Crédito</option>
          <option {{isset($pedido) && $pedido->forma_pagamento == 'Cartão de Débito' ? 'selected' : ''}} value="Cartão de Débito">Cartão de Débito</option>
          <option {{isset($pedido) && $pedido->forma_pagamento == 'Conta do Cliente' ? 'selected' : ''}} value="Conta do Cliente">Conta do Cliente</option>
        </select>
      </div>
    </div>

    <div class="form-group col-md-3">
      <label class="col-md-12 control-label ml-2" for="local_pagamento">Local de Pagamento*</label>
      <div class="col-md-12">
        <select id="local_pagamento" name="local_pagamento" class="form-control js-example-basic-single" required>
          <option {{isset($pedido) && $pedido->local_pagamento == 'Local de Entrega' ? 'selected' : ''}} value="Local de Entrega">Local de Entrega</option>
          <option {{isset($pedido) && $pedido->local_pagamento == 'Balcao' ? 'selected' : ''}} value="Balcao">Balcão</option>
          <option {{isset($pedido) && $pedido->local_pagamento == 'Mesa' ? 'selected' : ''}} value="Mesa">Mesa</option>
        </select>
      </div>
    </div>

    <div class="col-md-2">
      <label for="troco" class="col ml-2">Troco</label>
      <div class="input-group col">
        <div class="input-group-prepend">
          <span class="input-group-text sifra-troco">R$</span>
        </div>
        <input type="text" value="{{isset($pedido) ? $pedido->valortroco : old('troco')}}" placeholder="0" name="troco" class="form-control text-center troco">
        @include('alerts.feedback', ['field' => 'troco'])
      </div>
    </div>

    <div class="col-md-2">
      <label for="desconto" class="col ml-2">Desconto</label>
      <div class="input-group col">
        <div class="input-group-prepend">
          <span class="input-group-text sifrao">R$</span>
        </div>
        <input type="text" value="{{isset($pedido) ? $pedido->desconto : old('desconto')}}" placeholder="0" name="desconto" class="form-control desconto text-center" id="desconto" readonly>
        @include('alerts.feedback', ['field' => 'desconto'])
      </div>
    </div>

    <div class="col-md-2">
      <label for="total" class="col ml-3">Total</label>
      <div class="input-group col">
        <div class="input-group-prepend">
          <span class="input-group-text sifra">R$</span>
        </div>
        <input type="text" readonly value="{{isset($pedido) ? $pedido->total : '0'}}" name="total" class="form-control total text-center" id="total">
        @include('alerts.feedback', ['field' => 'total'])
      </div>
    </div>

  </div>

  {{-- fim forma de pagamento e valor total --}}

  <div class="row">
    <div class="col-md-12 pr-3">
      <div class="form-group">
        <label for="observacao" class="col ml-1">Observação do pedido</label>
        <input type="text" class="form-control" value="{{isset($pedido) ? $pedido->observacao : old('observacao')}}" id="observacao" name="observacao" placeholder="Observação">
        @include('alerts.feedback', ['field' => 'observacao'])
      </div>
    </div>
  </div>
</div>

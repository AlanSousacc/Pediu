<div class="content">
  <div class="row">
    <div class="form-group col-md-6">
      <label for="tipo">Tipo*</label>
      <select id="tipo" class="form-control" name="tipo" required>
        <option {{isset($tipo) && $tipo == 'entrada' ? 'selected' : '' }} value="Entrada">Entrada</option>
        <option {{isset($tipo) && $tipo == 'saida' ? 'selected' : '' }} value="Saída">Saída</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="forma_pagamento">Forma de Pagamento*</label>
      <select id="forma_pagamento" class="form-control" name="forma_pagamento" required>
        <option value="Dinheiro" >Dinheiro</option>
        <option value="Cartão de Crédito">Cartão de Crédito</option>
        <option value="Cartão de Débito">Cartão de Débito</option>
        <option value="Conta do Cliente">Conta do Cliente</option>
      </select>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-12">
      <label for="contato_id">Clientes</label>
      <select id="contato_id" class="form-control" name="contato_id">
        <option value="0" >Listar Contatos</option>
        @foreach ($contatos as $item)
        <option value="{{$item->id}}">{{$item->nome}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <label for="valortotal" class="col-sm-12 col-form-label">Valor Total*</label>
      <div class="input-group input-group-md">
        <div class="input-group-prepend">
          <span class="input-group-text">R$</span>
        </div>
        <input type="text" name="valortotal" class="form-control valortotal" value="{{isset($produto) ? number_format($produto->valortotal, 2, ',', '.') : old('valortotal')}}" id="valortotal" required>
      </div>
    </div>
    <div class="col-md-6">
      <label for="valorrecebido" class="col-sm-12 col-form-label">Valor Pago / Recebido</label>
      <div class="input-group input-group-md">
        <div class="input-group-prepend">
          <span class="input-group-text">R$</span>
        </div>
        <input type="text" name="valorrecebido" class="form-control valorrecebido" value="{{isset($produto) ? number_format($produto->valorrecebido, 2, ',', '.') : old('valorrecebido')}}" id="valorrecebido" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="observacao">Observação*</label>
        <textarea class="form-control" id="observacao" name="observacao" value="{{isset($produto) ? $produto->observacao : old('observacao')}}" placeholder="Observação da movimentação" required></textarea>
        @include('alerts.feedback', ['field' => 'observacao'])
      </div>
    </div>
  </div>
</div>

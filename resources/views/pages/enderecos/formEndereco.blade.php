<div class="content">
  <div class="row">
    <div class="form-group col-md-4">
      <label for="status">Status*</label>
      <select id="status" class="form-control" name="status">
        <option value="1" >Ativo</option>
        <option value="0" >Inativo</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="principal">Endereço principal?*</label>
      <select id="principal" class="form-control" name="principal">
        <option value="1" @if (isset($entrega->principal) && $entrega->principal == 1) selected @endif >Sim</option>
        <option value="0" @if (isset($entrega->principal) && $entrega->principal == 0) selected @endif >Não</option>
      </select>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="endereco">Endereço*</label>
        <input type="text" class="form-control" id="endereco" name="endereco" value="{{isset($entrega) ? $entrega->endereco : old('endereco')}}" placeholder="Rua:..." required>
        @include('alerts.feedback', ['field' => 'endereco'])
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="numero">Número*</label>
        <input type="text" class="form-control" id="numero" name="numero" value="{{isset($entrega) ? $entrega->numero : old('numero')}}" placeholder="000" required>
        @include('alerts.feedback', ['field' => 'numero'])
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="bairro">Bairro</label>
        <input type="text" class="form-control" id="bairro" name="bairro" value="{{isset($entrega) ? $entrega->bairro : old('bairro')}}" placeholder="Bairro">
        @include('alerts.feedback', ['field' => 'bairro'])
      </div>
    </div>
    
  </div>
  
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="cidade">Cidade</label>
        <input type="text" class="form-control" id="cidade" name="cidade" value="{{isset($entrega) ? $entrega->cidade : old('cidade')}}" placeholder="Cidade.">
        @include('alerts.feedback', ['field' => 'cidade'])
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="cep">CEP</label>
        <input type="text" class="form-control" id="cep" name="cep" value="{{isset($entrega) ? $entrega->cep : old('cep')}}" placeholder="Ex. 00000-000">
        @include('alerts.feedback', ['field' => 'cep'])
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="telefone_entrega">Telefone Entrega</label>
        <input type="text" class="form-control telefone_entrega" id="telefone_entrega" name="telefone_entrega" value="{{isset($entrega) ? $entrega->telefone_entrega : old('telefone_entrega')}}" placeholder="Ex. (99) 99999-9999">
        @include('alerts.feedback', ['field' => 'telefone_entrega'])
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="observacao">Observação</label>
        <input type="text" class="form-control" id="observacao" name="observacao" value="{{isset($entrega) ? $entrega->observacao : old('observacao')}}" placeholder="Observação, ponto de referência...">
        @include('alerts.feedback', ['field' => 'observacao'])
      </div>
    </div>
  </div>
</div>
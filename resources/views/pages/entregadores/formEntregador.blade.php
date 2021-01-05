<div class="content">
  <div class="row">
    <div class="form-group col-md-4">
      <label for="status">Status*</label>
      <select id="status" class="form-control" name="status">
        <option value="1" >Ativo</option>
        <option value="0" >Inativo</option>
      </select>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="nome">Nome*</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{isset($entregador) ? $entregador->nome : old('nome')}}" placeholder="Nome do Entregador" required>
        @include('alerts.feedback', ['field' => 'nome'])
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="endereco">Endereço</label>
        <input type="text" class="form-control" id="endereco" name="endereco" value="{{isset($entregador) ? $entregador->endereco : old('endereco')}}" placeholder="Endereço do entregador">
        @include('alerts.feedback', ['field' => 'endereco'])
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="numero">Número</label>
        <input type="text" class="form-control" id="numero" name="numero" value="{{isset($entregador) ? $entregador->numero : old('numero')}}" placeholder="000">
        @include('alerts.feedback', ['field' => 'numero'])
      </div>
    </div>
    
  </div>
  
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="cidade">Cidade</label>
        <input type="text" class="form-control" id="cidade" name="cidade" value="{{isset($entregador) ? $entregador->cidade : old('cidade')}}" placeholder="Cidade.">
        @include('alerts.feedback', ['field' => 'cidade'])
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="bairro">Bairro</label>
        <input type="text" class="form-control bairro" id="bairro" name="bairro" value="{{isset($entregador) ? $entregador->bairro : old('bairro')}}" placeholder="Bairro">
        @include('alerts.feedback', ['field' => 'bairro'])
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="telefone">Telefone*</label>
        <input type="text" class="form-control" id="telefone" name="telefone" value="{{isset($entregador) ? $entregador->telefone : old('telefone')}}" placeholder="Ex. (99) 99999-9999)" required>
        @include('alerts.feedback', ['field' => 'telefone'])
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="cep">CEP</label>
        <input type="text" class="form-control" id="cep" name="cep" value="{{isset($entregador) ? $entregador->cep : old('cep')}}" placeholder="Ex. 00000-000">
        @include('alerts.feedback', ['field' => 'cep'])
      </div>
    </div>
    <div class="form-group col-md-4">
      <label for="veiculo">Vaículo*</label>
      <select id="veiculo" class="form-control" name="veiculo" required>
        <option value="Carro">Carro</option>
        <option value="Moto">Moto</option>
        <option value="Bicicleta">Bicicleta</option>
        <option value="Nenhum">Nenhum</option>
      </select>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="placa">Placa Veículo</label>
        <input type="text" class="form-control" id="placa" name="placa" value="{{isset($entregador) ? $entregador->placa : old('placa')}}" placeholder="Placa do Veículo">
        @include('alerts.feedback', ['field' => 'placa'])
      </div>
    </div>
  </div>
</div>
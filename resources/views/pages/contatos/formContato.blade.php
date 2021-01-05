<div class="content">
  <div class="row">
    <div class="form-group col-md-4">
      <label for="tipo">Tipo de Contato*</label>
      <select id="tipo" class="form-control" name="tipo">
        <option value="Cliente" >Cliente</option>
        <option value="Fornecedor" >Fornecedor</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="ativo">Status*</label>
      <select id="ativo" class="form-control" name="ativo">
        <option value="1" @if (isset($contato->ativo) && $contato->ativo == 1) selected @endif >Ativo</option>
        <option value="0" @if (isset($contato->ativo) && $contato->ativo == 0) selected @endif >Inativo</option>
      </select>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="nome">Nome Completo*</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{isset($contato) ? $contato->nome : old('nome')}}" placeholder="Digite o nome completo" required>
        @include('alerts.feedback', ['field' => 'nome'])
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
          <label for="documento">Documento</label>
          <input type="text" class="form-control" id="documento" name="documento" value="{{isset($contato) ? $contato->documento : old('documento')}}" placeholder="Ex. 000.000.000-00">
          @include('alerts.feedback', ['field' => 'documento'])
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
          <label for="telefone">Telefone*</label>
          <input type="text" class="form-control telefone" id="telefone" name="telefone" value="{{isset($contato) ? $contato->telefone : old('telefone')}}" placeholder="Ex. (99) 99999-9999" required>
          @include('alerts.feedback', ['field' => 'telefone'])
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

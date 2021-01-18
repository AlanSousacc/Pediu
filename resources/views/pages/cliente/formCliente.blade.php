<div class="content">
  <h5 class="title font-weight-light">Dados do Contratante</h5>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="nome">Nome Contratante*</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome')}}" placeholder="João da Silva" required>
        @include('alerts.feedback', ['field' => 'nome'])
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        <label for="cidade">Cidade*</label>
        <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade')}}" placeholder="São Paulo" required>
        @include('alerts.feedback', ['field' => 'cidade'])
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        <label for="endereco">Endereço*</label>
        <input type="text" class="form-control" id="endereco" name="endereco" value="{{ old('endereco')}}" placeholder="Av: Paulista" required>
        @include('alerts.feedback', ['field' => 'endereco'])
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label for="numero">Número*</label>
        <input type="tel" class="form-control" id="numero" name="numero" value="{{ old('numero')}}" placeholder="123" required>
        @include('alerts.feedback', ['field' => 'numero'])
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="bairro">Bairro*</label>
        <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro')}}" placeholder="Centro" required>
        @include('alerts.feedback', ['field' => 'bairro'])
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="celular">Celular*</label>
        <input type="tel" class="form-control celular" id="celular" name="celular" value="{{ old('celular')}}" placeholder="Ex. (99) 99999-9999" required>
        @include('alerts.feedback', ['field' => 'celular'])
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="email">Email*</label>
        <input type="email" class="form-control email" id="email" name="email" value="{{ old('email')}}" placeholder="seu@email.com.br" required>
        @include('alerts.feedback', ['field' => 'email'])
      </div>
    </div>
  </div>

  <h5 class="title font-weight-light mt-4">Dados da Empresa</h5>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="razao">Razão Social*</label>
        <input type="text" class="form-control" id="razao" name="razao" value="{{ old('razao')}}" placeholder="Razão Social" required>
        @include('alerts.feedback', ['field' => 'razao'])
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="fantasia">Nome Fantasia*</label>
        <input type="text" class="form-control fantasia" id="fantasia" name="fantasia" value="{{ old('fantasia')}}" placeholder="Nome Fantasia" required>
        @include('alerts.feedback', ['field' => 'fantasia'])
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="cnpj">CNPJ*</label>
        <input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="{{ old('cnpj')}}" placeholder="Ex. 99.999.999/0001-99" required>
        @include('alerts.feedback', ['field' => 'cnpj'])
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="telefone">Telefone</label>
        <input type="text" class="form-control telefone" id="telefone" name="telefone" value="{{ old('telefone')}}" placeholder="Ex. (99) 9999-9999">
        @include('alerts.feedback', ['field' => 'telefone'])
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <label for="telefone">Logomarca</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="logo" name="logo">
        <label class="custom-file-label" for="customFile">Escolha sua logo</label>
      </div>
    </div>
  </div>
</div>

<div class="content">
  <div class="row">
    <div class="form-group col-md-2">
      <label for="status">Status*</label>
      <select id="status" class="form-control" name="status" required>
        <option value="1" >Ativo</option>
        <option value="0" >Inativo</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="tipo">Tipo de Produto*</label>
      <select id="tipo" class="form-control" name="tipo" required>
        <option value="Produto Final" >Produto Final</option>
        <option value="Adicional" >Produto Adicional</option>
        <option value="Outros" >Outros</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="grupo_id">Grupo</label>
      <select id="grupo_id" class="form-control" name="grupo_id" required>
        <option value="0" >Escolha um grupo</option>
        @foreach ($grupos as $item)
        <option value="{{$item->id}}" {{(old('grupo_id') == $item->id ) ? 'selected' : ''}} >{{$item->descricao}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label for="descricao">Descrição*</label>
        <input type="text" class="form-control" id="descricao" name="descricao" value="{{isset($produto) ? $produto->descricao : old('nome')}}" placeholder="Descrição do Produto" required>
        @include('alerts.feedback', ['field' => 'descricao'])
      </div>
    </div>
    <div class="col-md-7">
      <div class="form-group">
        <label for="composicao">Composição*</label>
        <input type="text" class="form-control" id="composicao" name="composicao" value="{{isset($produto) ? $produto->composicao : old('composicao')}}" placeholder="Ingredientes que compões este produto" required>
        @include('alerts.feedback', ['field' => 'composicao'])
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <label for="precocusto" class="col-sm-12 col-form-label">Pr. Custo</label>
      <div class="input-group input-group-md">
        <div class="input-group-prepend">
          <span class="input-group-text">R$</span>
        </div>
        <input type="text" name="precocusto" class="form-control precocusto" value="{{isset($produto) ? $produto->precocusto : old('precocusto')}}" id="precocusto">
        @include('alerts.feedback', ['field' => 'precocusto'])
      </div>
    </div>

    <div class="col-md-3">
      <label for="precovenda" class="col-sm-12 col-form-label">Pr. Venda</label>
      <div class="input-group input-group-md">
        <div class="input-group-prepend">
          <span class="input-group-text">R$</span>
        </div>
        <input type="text" name="precovenda" class="form-control precovenda" value="{{isset($produto) ? $produto->precovenda : old('precovenda')}}" id="precovenda">
        @include('alerts.feedback', ['field' => 'precovenda'])
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <label for="foto">Imagem</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="foto" name="foto">
        <label class="custom-file-label" for="customFile">Escolha sua Imagem</label>
      </div>
    </div>
    <div class="col-md-4 offset-2">
      <img id="imgfoto" src="{{ isset($produto) && $produto->foto != 'default.png' ? url("storage/".$produto->foto) : url("storage/img/logos/default.png")}} " alt="Imagem do produto" style="max-width: 150px"/>
    </div>
  </div>
  <input type="hidden" id="carregafoto" name="carregafoto" value="">
</div>

<div class="content">
  <div class="row">
    <div class="col-md-9 mb-3">
      <label for="descricao" class="ml-3">Descrição</label>
      <input type="text" style="padding:12px" class="form-control" name="descricao" id="descricao" value="{{isset($complemento) ? $complemento->descricao : old('descricao')}}" placeholder="Descrição do Complemento" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="preco" class="ml-3">Preço</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">R$</span>
        </div>
        <input type="text" class="form-control" id="preco" name="preco" placeholder="0,00" value="{{isset($complemento) ? number_format($complemento->preco, 2, ',', '.') : old('preco')}}" required>
      </div>
    </div>
  </div>
</div>

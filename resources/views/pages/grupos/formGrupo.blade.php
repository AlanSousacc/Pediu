<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="descricao">Descrição*</label>
        <input type="text" class="form-control" id="descricao" name="descricao" value="{{isset($grupo) ? $grupo->descricao : old('descricao')}}" placeholder="Descrição do grupo" required>
        @include('alerts.feedback', ['field' => 'descricao'])
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <label for="image">Imagem</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="image" name="image">
        <label class="custom-file-label" for="customFile">Imagem do grupo</label>
      </div>
    </div>
    <div class="col-md-4 offset-2">
      <img id="imgimage" src="{{ isset($grupo) ? url("storage/" .$grupo->image) : url("storage/img/logos/default.png")}} " alt="Imagem do grupo" style="max-width: 150px"/>
    </div>
  </div>
  <input type="hidden" id="carregaimage" name="carregaimage" value="">
</div>

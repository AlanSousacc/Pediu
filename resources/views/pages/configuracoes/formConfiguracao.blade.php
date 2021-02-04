<div class="content">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" name="controlaentrega" id="controlaentrega"
          {{$config->controlaentrega != null && $config->controlaentrega == 1 ?	'checked' : ''}}>
          <label class="custom-control-label pt-1" for="controlaentrega">Controla Entrega</label>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="d-flex align-items-center">
        <label class="text-nowrap mr-3 mb-0" for="fd-change">Valor padrão de entrega:</label>
        <div class="input-group" style="width: 8rem;">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-dollar-sign"></i></span></div>
          <input class="form-control bg-0 pr-3" type="text" id="fd-change" name="valorentrega" value="{{number_format($config->valorentrega, 2, ',', '.')}}">
        </div>
      </div>
    </div>
  </div>
</div>

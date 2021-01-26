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
  </div>
</div>

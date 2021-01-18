<div class="row">
	<div class="col-md-4">
    <div class="form-group">
      <label for="status">Status Licença</label>
      <div class="input-group">
        <select class="form-control status" id="status" name="status" {{old('status')}} required>
          <option value="1">Licença Ativa</option>
          <option value="0">Licença Bloqueada</option>
        </select>
      </div>
    </div>
	</div>

	<div class="form-group col-md-12">
		<label for="validade" class="col-md-4">Validade</label>
		<div id="validade" name="validade" class="form-control enableValidade">
			<i class="fa fa-calendar"></i>&nbsp;
			<span></span> <i class="fa fa-caret-down"></i>
			<input type="hidden" name="valstart" id="valstart">
			<input type="hidden" name="valend" id="valend">
		</div>
	</div>
</div>

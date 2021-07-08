<div class="modal fade" id="licenca" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document" style="min-width:600px">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center; display: inline;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title m-0">Gerar Licença da Empresa</h4>
      </div>
      <form action="{{route('licenca.store')}}" method="post">
				{{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="empresa_id" id="emprid" value="">
					@include('pages.licenca.formLicenca')
					<input type="hidden" name="_token" value="{{csrf_token()}}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success consulta-resumo">Confirmar</button>
        </div>
      </form>
    </div>
  </div>
</div>

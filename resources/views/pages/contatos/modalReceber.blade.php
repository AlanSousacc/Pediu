<div class="modal fade" id="receber" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="min-width:300px">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center; display: inline;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Receber Valor</h4>
      </div>
      <form autocomplete="off" action="{{route('recebebimento.cliente', $item->id)}}" method="get">
				{{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="movimentacaoid" id="movimentacaoid" value="">
          <input type="hidden" name="restante" id="restante" value="">
          @include('pages.financeiro.formReceberPagar')
        </div>
        <div class="modal-footer d-block px-0">
					<div class="row mx-0">
						<div class="col-md-6 mb-1">
							<button type="submit" class="btn btn-success receber-movimentacao w-100"><i class="fa fa-check-circle"></i> Receber</button>
						</div>
						<div class="col-md-6 mb-1">
							<button type="button" class="btn btn-default w-100" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
						</div>
					</div>
				</div>
      </form>
    </div>
  </div>
</div>

<div id="movimentacaoreforco" class="modal fade text-default" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info" style="text-align: center; display: inline;">
				<button type="button" aria-hidden="true" data-dismiss="alert" class="close">
					<i class="now-ui-icons ui-1_simple-remove" style="color: #fff"></i>
			</button>
				<h4 class="modal-title text-center" style="color:#fff">Movimentação Avulsa - Reforço</h4>
			</div>
			<form action="{{route('movimentacao.caixa')}}" method="post">
				{{csrf_field()}}
				<div class="modal-body">
					@include('pages.financeiro.formMovimentacao')
				</div>
				<div class="modal-footer d-block px-0">
					<div class="row mx-0">
						<div class="col-md-6 mb-1">
							<button type="submit" class="btn btn-success w-100"><i class="fa fa-check-circle"></i> Concluir Reforço</button>
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

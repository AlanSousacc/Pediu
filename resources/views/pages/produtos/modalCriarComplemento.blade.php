<div id="createcomplemento" class="modal fade bd-example-modal-lg text-primary" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary" style="text-align: center; display: inline;">
				<button type="button" aria-hidden="true" data-dismiss="alert" class="close">
					<i class="now-ui-icons ui-1_simple-remove" style="color: #fff"></i>
			</button>
				<h4 class="modal-title text-center" style="color:#fff">Cadastro de Complemento</h4>
			</div>
			<form action="{{route('complemento.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
        {{csrf_field()}}
				<div class="modal-body">
          @include('pages.complementos.formComplemento')
				</div>
				<div class="modal-footer">
					<center>
						<button type="submit" class="btn btn-success" >Salvar Complemento</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</center>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="baixar" class="modal fade text-danger" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary" style="text-align: center; display: inline;">
				<button type="button" aria-hidden="true" data-dismiss="alert" class="close">
					<i class="now-ui-icons ui-1_simple-remove" style="color: #fff"></i>
			</button>
				<h4 class="modal-title text-center" style="color:#fff">Confirmar Recebimento</h4>
			</div>
			<form  method="get">
				{{ csrf_field() }}
				<div class="modal-body">
					<p class="text-center text-primary">Você confirma o recebimento total de R$ <strong><span id="vltotal" class="medi"></span></strong> <br>do entregador <strong><span id="entregador"></span></strong></p>
					<input type="hidden" name="pedido_id" id="contid" value="">
					<input type="hidden" name="valorpedido" id="valorpedido" value="">
				</div>
				<div class="modal-footer">
					<center>
						<button type="submit" class="btn btn-primary" >Sim, Baixar</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</center>
				</div>
			</form>
		</div>
	</div>
</div>

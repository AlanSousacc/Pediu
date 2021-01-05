<div id="impressao" class="modal fade text-default" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-success" style="text-align: center; display: inline;">
				<button type="button" aria-hidden="true" data-dismiss="alert" class="close">
					<i class="now-ui-icons ui-1_simple-remove" style="color: #fff"></i>
				</button>
				<h4 class="modal-title text-center" style="color:#fff">Impressão do Pedido</h4>
			</div>
			<form action="{{route('imprimir.pedido.venda')}}" method="get">
				{{ csrf_field() }}
				<div class="modal-body">
					<p class="text-center">O pedido foi realizado com sucesso, agora você pode imprimi-lo.</p>
					<p class="text-center">Você deseja realizar a impressão deste pedido?</p>
					<input type="hidden" name="pedido_id" id="pedido_id" value="">
				</div>
				<div class="modal-footer">
					<center>
						<a href="{{route('imprimir.pedido.venda', session()->get('pedido') )}}" target="_blank"  class="btn btn-success imprimir" >Sim, Imprimir</a>
						<button type="button" class="btn btn-default" data-dismiss="modal">Não, Fechar!</button>
					</center>
				</div>
			</form>
		</div>
	</div>
</div>
	
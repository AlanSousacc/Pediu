<div class="modal fade" id="mudarStatus" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="min-width:300px">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center; display: inline;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Definir Entregador</h4>
      </div>
      <form autocomplete="off" action="{{route('pedido.status', 'id')}}" method="get">
				{{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="pedidoid" id="pedidoid" value="">
          @include('pages.pedidos.formStatusEntregador')
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Definir Entregador</button>
          <button type="button" class="btn btn-danger mr-4" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

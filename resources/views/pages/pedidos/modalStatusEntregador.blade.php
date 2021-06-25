<div class="modal fade" id="mudarStatus" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document" style="min-width:300px">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center; display: inline;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title mt-0">Definir Entregador</h4>
      </div>
      <form autocomplete="off" action="{{route('pedido.status', 'id')}}" method="get">
				{{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="pedidoid" id="pedidoid" value="">
          @include('pages.pedidos.formStatusEntregador')
        </div>

        <div class="modal-footer d-block px-0">
          <div class="row w-100 m-0">
            <div class="col-md-6 mb-1">
              <button type="submit" class="btn btn-success w-100">Definir Entregador</button>
            </div>
            <div class="col-md-6 mb-1">
              <button type="button" class="btn btn-danger w-100" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
        
      </form>
    </div>
  </div>
</div>

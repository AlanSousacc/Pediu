<div class="modal fade" id="mudarStatus" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document" style="min-width:300px">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center; display: inline;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title m-0">Alterar Status do Pedido</h4>
      </div>
      <form autocomplete="off" action="{{route('pedidoloja.status', 'id')}}" method="get" id="formstatus">
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="pedidoid" id="pedidoid" value="">
          <select name="status" required="" class="form-control status">
            <option value="" disabled="" selected="">Atualizar Status</option>
            <option value="1">Aprovado</option>
            <option value="2">Em Andamento</option>
            <option value="3">Saiu para Entrega</option>
            <option value="4">Finalizado</option>
            <option value="5">Cancelado</option>
          </select>
          <div class="form-group mt-4">
            <label for="campomsg"class="d-inline" >Mensagem para o Cliente via WhatsApp</label>
            <textarea id="campomsg" name="campomsg" required class="w-100" rows="5" style="border: 1px solid #ccc; font-size: 13px;"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle" style="font-size: 15px;"></i> Cancelar</button>
          <button type="button" class="btn btn-info define-somente"><i class="fa fa-check-circle" style="font-size: 15px;"></i> Somente Definir</button>
          <button type="button" class="btn btn-success define-envia"><i class="fab fa-whatsapp" style="font-size: 15px;"></i> Definir e Enviar</button>
        </div>
      </form>
    </div>
  </div>
</div>

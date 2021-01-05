<div class="modal fade" id="receber" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="min-width:300px">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center; display: inline;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Receber Valor</h4>
      </div>
      <form autocomplete="off" action="{{route('movimentacao.receber', $item->id)}}" method="get">
				{{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="movimentacaoid" id="movimentacaoid" value="">
          <input type="hidden" name="restante" id="restante" value="">
          <div class="row">
            <div class="col-md-12">
              <label for="valorrecebido" class="ml-4">Valor Total</label>
              <div class="input-group col">
                <div class="input-group-prepend">
                  <span class="input-group-text sifra">R$</span>
                </div>
                <input type="text" class="form-control text-center" id="valtotal" name="valtotal" value="" readonly>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label for="valorrecebido" class="ml-4">Valor Recebido</label>
              <div class="input-group col">
                <div class="input-group-prepend">
                  <span class="input-group-text sifra">R$</span>
                </div>
                <input type="text" class="form-control text-center" id="valorrecebido" name="valorrecebido" value="" readonly>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label for="valorpendente" class="ml-4">Valor a Receber</label>
              <div class="input-group col">
                <div class="input-group-prepend">
                  <span class="input-group-text">R$</span>
                </div>
                <input type="text" class="form-control text-center" id="valorpendente" name="valorpendente" value="" aria-describedby="valorpendente" required>
                <div id="valorpendente" class="invalid-feedback">
                  Valor a receber informado é maior que o valor total, ou maior que o valor restante!
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success receber-movimentacao">Receber</button>
          <button type="button" class="btn btn-danger mr-4" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

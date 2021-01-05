<div class="modal fade" id="resumoperiodo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="min-width:300px">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center; display: inline;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Filtrar por Período</h4>
      </div>
      <form autocomplete="off" action="{{route('pedidos.resumo.periodo')}}" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Data e Hora Inicial</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" autocomplete="off" id="dtstart" placeholder="Data/Hora Inicio" name="dtstart">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Data e Hora Final</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" autocomplete="off" id="dtend" placeholder="Data/Hora Final" name="dtend">
              <div class="invalid-feedback">
                Por favor informe uma data final quando informado uma data inicial!
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success consulta-resumo">Consultar</button>
        </div>
      </form>
    </div>
  </div>
</div>

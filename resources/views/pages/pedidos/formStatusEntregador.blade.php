<div class="row">
  <div class="form-group col-md-12">
    <p class="h5 text-center">Pedido Processado, aguardando entregador</p>
  </div>
</div>
<div class="row">
  
  <div class="form-group col entregador-list">
    <label for="entregador_id" class=" ml-3">Listagem de Entregadores</label>
    <div class="col-md-12">
      <select id="entregador_id" name="entregador_id" class="form-control js-example-basic-single" required>
        @foreach ($entregador as $item)
        <option value="{{$item->id}}" {{(old('entregador_id') == $item->id ) ? 'selected' : ''}} >{{$item->nome}}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>

<div class="row">
  <div class="form-group col-md-12 troco-modal">
    <label for="troco" class="col ml-3">Troco</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">R$</span>
      </div>
      <input type="text" value="0" name="troco" class="form-control text-center troco-modal-input">
    </div>
  </div>
</div>
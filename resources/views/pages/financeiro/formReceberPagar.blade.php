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
    <label for="valorrecebido" class="ml-4" id="labelrecebidopago">Valor Recebido</label>
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
    <label for="valorpendente" class="ml-4" id="labelreceberpagar">Valor a Receber</label>
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

<div class="row">
  <div class="col-md-12">
    <label class="ml-4 mb-0" id="forma">Forma de Recebimento</label>
    <div class="input-group col d-block text-center">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="formarecebimento" id="dinheiro" value="Dinheiro" required>
        <label class="form-check-label p-1" for="dinheiro">Dinheiro</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="formarecebimento" id="cartao-credito" value="Cartão de Crédito" required>
        <label class="form-check-label p-1" for="cartao-credito">Cartão Credito.</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="formarecebimento" id="cartao-debito" value="Cartão de Débito" required>
        <label class="form-check-label p-1" for="cartao-debito">Cartão Débito.</label>
      </div>
    </div>
  </div>
</div>
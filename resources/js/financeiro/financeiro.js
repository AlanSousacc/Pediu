$('#pagar').on('show.bs.modal', function (event) {
  var button           = $(event.relatedTarget);
  var movimentacaoid   = button.data('movimentacaoid');
  var valtotal         = button.data('valtotal');
  var valorrecebido    = button.data('valorrecebido');
  var valorpendente    = button.data('valorpendente');
  var restante         = button.data('restante');
  var tipo             = button.data('tipo');

  var modal            = $(this);
  modal.find('.modal-body #restante').val((valtotal - valorrecebido).toFixed(2));
  modal.find('.modal-body #movimentacaoid').val(movimentacaoid);
  modal.find('.modal-body #valtotal').val(valtotal);
  modal.find('.modal-body #valorrecebido').val(valorrecebido);
  modal.find('.modal-body #valorpendente').val(valorpendente);
  modal.find('.modal-header .modal-title').text(tipo);
  modal.find('.modal-body #tipomovimentacao').val('Recebimento');
  
  if(tipo == "Pagar Restante"){
    modal.find('.modal-body #labelrecebidopago').text('Valor Pago');
    modal.find('.modal-body #labelreceberpagar').text('Valor a Pagar');
    modal.find('.modal-body #forma').text('Forma de Pagamento');
    modal.find('.modal-body #tipomovimentacao').val('Pagamento');
  }

  if(valorpendente > restante){
    $('.receber-movimentacao').prop('disabled', true)
    $('#valorpendente').addClass('is-invalid');
  } else {
    $('#valorpendente').removeClass('is-invalid');
    $('.receber-movimentacao').prop('disabled', false)
  }
});

$('#valorpendente').on('change', function(){
  if(Number($('#valorpendente').val()) > Number($('#valtotal').val()) || Number($('#valorpendente').val()) > Number($('#restante').val())){
    $('.receber-movimentacao').prop('disabled', true)
    $('#valorpendente').addClass('is-invalid');
  } else {
    $('#valorpendente').removeClass('is-invalid');
    $('.receber-movimentacao').prop('disabled', false)
  }
});

$(document).ready(function () {  
  $('#valorrecebido').mask("#.##0.00", {reverse: true});
  $('#valorpendente').mask("#.##0.00", {reverse: true});
  $('#valtotal').mask("#.##0.00", {reverse: true});
});
$('#delete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var contid = button.data('contid');
  var modal = $(this);
  modal.find('.modal-body #contid').val(contid);
});

$('#receber').on('show.bs.modal', function (event) {
  var button           = $(event.relatedTarget);
  var movimentacaoid   = button.data('movimentacaoid');
  var valtotal         = button.data('valtotal');
  var valorrecebido    = button.data('valorrecebido');
  var valorpendente    = button.data('valorpendente');
  var restante         = button.data('restante');

  var modal            = $(this);
  modal.find('.modal-body #restante').val((valtotal - valorrecebido).toFixed(2));
  modal.find('.modal-body #movimentacaoid').val(movimentacaoid);
  modal.find('.modal-body #valtotal').val(valtotal);
  modal.find('.modal-body #valorrecebido').val(valorrecebido);
  modal.find('.modal-body #valorpendente').val(valorpendente);

  if(valorpendente > restante){
    $('.receber-movimentacao').prop('disabled', true)
    $('#valorpendente').addClass('is-invalid');
  } else {
    $('#valorpendente').removeClass('is-invalid');
    $('.receber-movimentacao').prop('disabled', false)
  }
});

$('#valorpendente').on('change', function(){
  if($('#valorpendente').val() > $('#valtotal').val() || $('#valorpendente').val() > $('#restante').val()){
    $('.receber-movimentacao').prop('disabled', true)
    $('#valorpendente').addClass('is-invalid');
  } else {
    $('#valorpendente').removeClass('is-invalid');
    $('.receber-movimentacao').prop('disabled', false)
  }
});

$(document).ready(function () {
	$('.telefone').mask('(00) 00000-0000');
  $('#cep').mask('00000-000');
  
  $('#valorrecebido').mask("#.##0.00", {reverse: true});
  $('#valorpendente').mask("#.##0.00", {reverse: true});
  $('#valtotal').mask("#.##0.00", {reverse: true});

  $('#documento').mask('000.000.000-00', {
    reverse: true
	});
});

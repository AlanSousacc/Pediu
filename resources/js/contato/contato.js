$('#delete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var contid = button.data('contid');
  var modal = $(this);
  modal.find('.modal-body #contid').val(contid);
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

$('#licencaempresa').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var empuuid = button.data('empuuid');
  var modal  = $(this);
  modal.find('.modal-body #empuuid').val(empuuid);
});

$(document).ready(function () {
	$('.telefone').mask('(00) 0000-0000');
	$('.celular').mask('(00) 00000-0000');

  $('#cnpj').mask('00.000.000/0001-00');
});

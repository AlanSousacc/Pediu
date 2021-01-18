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

// $(function() {
//   $('#expires_at').val(start.format('YYYY-MM-DD'));
//   $('#expires_at').daterangepicker({
//     singleDatePicker: true,
//     "locale": {
//       "applyLabel": "Aplicar",
//       "cancelLabel": "Cancelar",
//       "format": "DD/MM/YYYY"
//     },
//     "startDate": moment(),
//     "endDate": moment()
//   });
// });

// $('#active').on('change',function(ev){
//   if($('#active').val() == 'N'){
//     $('#expires_at').attr('readonly', true);
//   } else {
//     $('#expires_at').attr('readonly', false);
//   }
// });

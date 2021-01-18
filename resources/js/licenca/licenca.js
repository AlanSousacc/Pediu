$('#licenca').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
	var emprid = button.data('emprid');
  var modal  = $(this);
  modal.find('.modal-body #emprid').val(emprid);
});

$(function() {
	var start = moment().subtract(29, 'days');
	var end = moment();

	function cb(start, end) {
		$('#validade span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
		$('#valstart').val(start.format('YYYY-MM-DD'));
		$('#valend').val(end.format('YYYY-MM-DD'));
	}

	$('#validade').daterangepicker({
		"locale": {
			"format": "MM/DD/YYYY",
			"separator": " - ",
			"applyLabel": "Aplicar",
			"cancelLabel": "Cancelar",
			"fromLabel": "De",
			"toLabel": "Para",
			"customRangeLabel": "Customizado",
			"weekLabel": "S",
			"daysOfWeek": [
					"Dom",
					"seg",
					"Ter",
					"qua",
					"qui",
					"Sex",
					"Sab"
			],
			"monthNames": [
					"Janeiro",
					"Fevereiro",
					"Março",
					"Abril",
					"Maio",
					"Junho",
					"Julho",
					"Agosto",
					"Setembro",
					"Outubro",
					"Novembro",
					"Dezembro"
			],
		},
		startDate: start,
		endDate: end,
	}, cb);
	cb(start, end);
});


$(document).ready(function(){
	$("select.status").change(function(){
		var select = $(this).children("option:selected").val();
		if (select == 0) {
			$("#validade").addClass("disableValidade");
			$("#validade").removeClass("enableValidade");
		} else{
			$("#validade").removeClass("disableValidade");
			$("#validade").addClass("enableValidade");
		}
	});
});

// $(function() {
//   $('input[name="daterange"]').daterangepicker({
//     opens: 'left'
//   }, function(start, end, label) {
//     console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
//   });
// });
// </script>

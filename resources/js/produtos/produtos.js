$('#delete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var contid = button.data('contid');
  var modal = $(this);
  modal.find('.modal-body #contid').val(contid);
});

$(document).ready(function () {
  $('#precocusto').mask("#.##0,00", {reverse: true});
  $('#precovenda').mask("#.##0,00", {reverse: true});
});
$('#delete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var contid = button.data('contid');
  var modal  = $(this);
  modal.find('.modal-body #contid').val(contid);
});

$('#baixar').on('show.bs.modal', function (event) {
  var button      = $(event.relatedTarget);
  var contid      = button.data('contid');
  var total       = button.data('total');
  var entregador  = button.data('entregador');
  var modal       = $(this);
  
  modal.find('.modal-body #contid').val(contid);
  modal.find('.modal-body #entregador').text(entregador);
  modal.find('.modal-body #vltotal').text(total);
  modal.find('.modal-body #valorpedido').val(total);
});

$('#mudarStatus').on('show.bs.modal', function (event) {
  var button        = $(event.relatedTarget);
  var pedidoid      = button.data('pedidoid');
  var statusentrega = button.data('statusentrega');
  var entregador_id = button.data('entregador_id');
  var valortroco    = button.data('valortroco');
  var troco         = button.data('troco');
  var modal         = $(this);
  
  modal.find('.modal-body .troco-modal-input').val(valortroco);
  modal.find('.modal-body #statusentrega').val(statusentrega).change();
  modal.find('.modal-body #entregador_id').val(entregador_id).change();
  modal.find('.modal-body #pedidoid').val(pedidoid);
  
  if(troco == 0){
    modal.find('.modal-body .troco-modal').css("display", "none");
  } else {
    modal.find('.modal-body .troco-modal').css("display", "block");
    $("input[name='troco']").mask("#.##0.00", {reverse: true});
  }
});

$(document).ready(function() {
  $('.js-example-basic-single').select2();
});
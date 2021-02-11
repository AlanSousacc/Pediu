$('#delete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var contid = button.data('contid');
  var modal = $(this);
  modal.find('.modal-body #contid').val(contid);
});


// $('#remover').on('shown.bs.modal', function (event) {
//   alert('hi');
//   var button = $(event.relatedTarget);
//   var contid = button.data('contid');
//   var modal = $(this);
//   modal.find('.modal-body #contid').val(contid);
// });

// $('#edit-address').on('show.bs.modal', function (event) {
//   var button    = $(event.relatedTarget);
//   var endereco  = button.data('endereco');
//   var numero    = button.data('numero');
//   var bairro    = button.data('bairro');
//   var cidade    = button.data('cidade');
//   var telefone  = button.data('telefone');
//   var modal     = $(this);

//   modal.find('.modal-body #endereco').val(endereco);
//   modal.find('.modal-body #numero').val(numero);
//   modal.find('.modal-body #bairro').val(bairro);
//   modal.find('.modal-body #cidade').val(cidade);
//   modal.find('.modal-body #telefone').val(telefone);
// });

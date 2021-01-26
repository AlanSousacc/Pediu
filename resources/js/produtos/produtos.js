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

$("#foto").change(function() {
  readURL(this);
});

$(document).ready(function() {
  if($('#imgfoto').attr('src') != 'default.png'){
    let foto = $('#imgfoto').attr('src');
    link = foto.substr(35);
    $('#carregafoto').val(link)
  }
});

// carrega imagem
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#imgfoto').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

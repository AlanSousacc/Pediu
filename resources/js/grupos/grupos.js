$('#delete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var contid = button.data('contid');
  var modal = $(this);
  modal.find('.modal-body #contid').val(contid);
});


$("#image").change(function() {
  readURL(this);
});

$(document).ready(function() {
  if($('#imgimage').attr('src') != 'default.png'){
    let image = $('#imgimage').attr('src');
    link = image.substr(35);
    $('#carregaimage').val(link)
  }
});

// carrega imagem
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#imgimage').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

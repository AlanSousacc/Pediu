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
  $('.js-example-products').select2();
  $('.js-example-basic-multiple').select2();
    
  $(document).on('keydown',function(event){
    if(event.keyCode == 113){
      $('.js-example-basic-single').select2('open');
    }
 });

});

// ==========================================================================================
// tela de pedidos, responsável por criar os steeps

$(document).ready(function(){

  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;

  $(".next").click(function(){
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
      step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        next_fs.css({'opacity': opacity});
      },
      duration: 600
    });
  });

  $(".previous").click(function(){
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
      step: function(now) {
      // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        previous_fs.css({'opacity': opacity});
      },
      duration: 600
    });
  });

  $('.radio-group .radio').click(function(){
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
  });

  $(".submit").click(function(){
    return false;
  })

});
$(document).ready(function () {
  $('.add-to-cart-btn').click(function (e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var product_id = $(this).closest('.product_data').find('.product_id').val();
    var quantity = $(this).closest('.product_data').find('.qty-input').val();
    $.ajax({
      url: "/add-to-cart",
      method: "POST",
      data: {
        'quantity': quantity,
        'product_id': product_id,
      },
      success: function (response) {
        alertify.set('notifier','position','bottom-center');
        alertify.success(response.status);
        window.location.reload();
      },
    });
  });
});

$(document).ready(function () {
  cartload();
});

function cartload(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: '/load-cart-data',
    method: "GET",
    success: function (response) {
      $('.navbar-tool-label').html('');
      $('.cz-handheld-toolbar-icon .carrinho').html('');
      var parsed = jQuery.parseJSON(response)
      var value = parsed; //Single Data Viewing
      $('.navbar-tool-label').append($('<span class="badge badge-pill red">'+ value['totalcart'] +'</span>'));
      $('.cz-handheld-toolbar-icon .carrinho').append($('<span class="badge badge-pill red ml-1">'+ value['totalcart'] +'</span>'));
    }
  });
}

$(document).ready(function () {
  $('.increment-btn').click(function (e) {
    e.preventDefault();
    var incre_value = $(this).parents('.quantity').find('.qty-input').val();
    var value = parseInt(incre_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value<10){
      value++;
      $(this).parents('.quantity').find('.qty-input').val(value);
    }
  });

  $('.decrement-btn').click(function (e) {
    e.preventDefault();
    var decre_value = $(this).parents('.quantity').find('.qty-input').val();
    var value = parseInt(decre_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value>1){
      value--;
      $(this).parents('.quantity').find('.qty-input').val(value);
    }
  });
});

// Update Cart Data
$(document).ready(function () {

  $('.changeQuantity').click(function (e) {
    e.preventDefault();
    var quantity = $(this).closest(".cartpage").find('.qty-input').val();
    var product_id = $(this).closest(".cartpage").find('.product_id').val();
    var data = {
      '_token': $('input[name=_token]').val(),
      'quantity':quantity,
      'product_id':product_id,
    };
    $.ajax({
      url: '/update-to-cart',
      type: 'POST',
      data: data,
      success: function (response) {
        window.location.reload();
        alertify.set('notifier','position','bottom-center');
        alertify.success(response.status);
      }
    });
  });
});

// Delete Cart Data
$(document).ready(function () {

  $('.delete_cart_data').click(function (e) {
    e.preventDefault();
    var product_id = $(this).closest(".cartpage").find('.product_id').val();
    var data = {
      '_token': $('input[name=_token]').val(),
      "product_id": product_id,
    };
    // $(this).closest(".cartpage").remove();
    $.ajax({
      url: '/delete-from-cart',
      type: 'DELETE',
      data: data,
      success: function (response) {
        window.location.reload();
      }
    });
  });
});

// Clear Cart Data
$(document).ready(function () {
  $('.clear_cart').click(function (e) {
    e.preventDefault();
    $.ajax({
      url: '/clear-cart',
      type: 'GET',
      success: function (response) {
        window.location.reload();
        alertify.set('notifier','position','bottom-center');
        alertify.success(response.status);
      }
    });
  });
});

// funções para habilitar campos de endereços de entrega
function verificaentrega(){
  if($('#enderecocadastro').prop("checked")){
    $(".novo-endereco").css("display", "none");
    $(".novo-endereco-form").css("display", "none");
    $(".meu-endereco").css("display", "block");
    $("#novo-endereco").prop("disabled", true);
    $("#novo-numero").prop("disabled", true);
    $("#nova-cidade").prop("disabled", true);
    $("#novo-telefone").prop("disabled", true);
  } else {
    $(".novo-endereco").css("display", "block");
    $(".meu-endereco").css("display", "none");
    $("#novo-endereco").prop("disabled", false);
    $("#novo-numero").prop("disabled", false);
    $("#nova-cidade").prop("disabled", false);
    $("#novo-telefone").prop("disabled", false);
  }
}

$('input[name=entrega]').on('change',function(ev){
  verificaentrega();
});

function verificaEntregaId(){
  if($('#outroendereconovo').prop("checked")){
    $(".novo-endereco-form").css("display", "block");
    $("#novo-endereco").prop('required', true);
    $("#novo-endereco").prop("disabled", false);
    $("#novo-numero").prop('required', true);
    $("#novo-numero").prop("disabled", false);
    $("#nova-cidade").prop('required', true);
    $("#nova-cidade").prop("disabled", false);
    $("#novo-telefone").prop('required', true);
    $("#novo-telefone").prop("disabled", false);
    $("#novo-bairro").prop("required", true);
    $("#novo-bairro").prop("disabled", false);
  } else {
    $(".novo-endereco-form").css("display", "none");
    $("#novo-endereco").prop("disabled", true);
    $("#novo-endereco").removeAttr("required");
    $("#novo-numero").prop("disabled", true);
    $("#novo-numero").removeAttr("required");
    $("#nova-cidade").prop("disabled", true);
    $("#nova-cidade").removeAttr("required");
    $("#novo-telefone").prop("disabled", true);
    $("#novo-telefone").removeAttr("required");
    $("#novo-bairro").prop("disabled", true);
    $("#novo-bairro").removeAttr("required");
  }
}

$('input[name=entrega_id]').on('change',function(ev){
  verificaEntregaId()
});

// habilita ou desabilita icone e input de troco
$('input[name=formapagamento]').on('change',function(ev){
  if($('#dinheiro').prop("checked")){
    $("#trocopara").prop("disabled", false);
  } else {
    $("#trocopara").prop("disabled", true);
    $("#trocopara").val("0,00");
  }
});

$(document).ready(function() {
  verificaentrega();
  verificaEntregaId()
  $('#novo-telefone').mask('(00) 00000-0000');
  $('#trocopara').mask("#.##0.00", {reverse: true});
  $("#trocopara").val("0,00");
});

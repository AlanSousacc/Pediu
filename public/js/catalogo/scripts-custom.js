/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 17);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/catalogo/scripts-custom.js":
/*!*************************************************!*\
  !*** ./resources/js/catalogo/scripts-custom.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $('.add-to-cart-btn').click(function (e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var product_id = $(this).closest('.product_data').find('.item_id').val();
    var quantity = $(this).closest('.product_data').find('.qty-input').val();
    var precoitem = $(this).closest('.product_data').find('#precovenda').text();
    var produtosize = $(this).closest('.product_data').find('.produtosize').val();
    var observacaoitem = $(this).closest('.product_data').find('#observacaoitem').val();
    var saboresdiversos = $(".saboresdiversos").select2("val");
    var complementos = new Array();
    $("input[name='complemento_id[]']:checked").each(function () {
      complementos.push($(this).val());
    });
    $.ajax({
      url: "/add-to-cart",
      method: "POST",
      data: {
        'quantity': quantity,
        'product_id': product_id,
        'precoitem': precoitem,
        'complementos': complementos,
        'produtosize': produtosize,
        'observacaoitem': observacaoitem,
        'saboresdiversos': saboresdiversos
      },
      success: function success(response) {
        Swal.fire('Muito Bem!', 'Este produto foi adicionado ao carrinho!', 'success'); // window.location.reload();
      },
      error: function error(response) {
        Swal.fire('Ops, algo deu errado!', 'Infelizmente houve um problema interno, e não conseguimos adicionar este item a seu carrinho. Código: ' + response.status, 'error'); // window.location.reload();
      }
    });
  });
}); // $(document).ready(function () {
//   cartload();
// });
// function cartload(){
//   $.ajaxSetup({
//     headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
//   });
//   $.ajax({
//     url: '/load-cart-data',
//     method: "GET",
//     success: function (response) {
//       console.log(response)
//       $('.navbar-tool-label').html('');
//       $('.cz-handheld-toolbar-icon .carrinho').html('');
//       var parsed = jQuery.parseJSON(response)
//       var value = parsed; //Single Data Viewing
//       $('.navbar-tool-label').append($('<span class="badge badge-pill red">'+ value['totalcart'] +'</span>'));
//       $('.cz-handheld-toolbar-icon .carrinho').append($('<span class="badge badge-pill red ml-1">'+ value['totalcart'] +'</span>'));
//     }
//   });
// }

$(document).ready(function () {
  $('.increment-btn').click(function (e) {
    e.preventDefault();
    var incre_value = $(this).parents('.quantity').find('.qty-input').val();
    var value = parseInt(incre_value, 10);
    value = isNaN(value) ? 0 : value;

    if (value < 10) {
      value++;
      $(this).parents('.quantity').find('.qty-input').val(value);
    }
  });
  $('.decrement-btn').click(function (e) {
    e.preventDefault();
    var decre_value = $(this).parents('.quantity').find('.qty-input').val();
    var value = parseInt(decre_value, 10);
    value = isNaN(value) ? 0 : value;

    if (value > 1) {
      value--;
      $(this).parents('.quantity').find('.qty-input').val(value);
    }
  });
}); // Update Cart Data

$(document).ready(function () {
  $('.changeQuantity').click(function (e) {
    e.preventDefault();
    var quantity = $(this).closest(".cartpage").find('.qty-input').val();
    var product_id = $(this).closest(".cartpage").find('.product_id').val();
    var data = {
      '_token': $('input[name=_token]').val(),
      'quantity': quantity,
      'product_id': product_id
    };
    $.ajax({
      url: '/update-to-cart',
      type: 'POST',
      data: data,
      success: function success(response) {
        Swal.fire('Eba!', 'Produto atualizado com sucesso!', 'success');
        window.location.reload();
      },
      error: function error(response) {
        Swal.fire('Ops, algo deu errado!', 'Infelizmente houve um problema interno, e não conseguimos atualizar este item no seu carrinho. Código: ' + response.status, 'error');
        window.location.reload();
      }
    });
  });
}); // Delete Cart Data

$(document).ready(function () {
  $('.delete_cart_data').click(function (e) {
    var _this = this;

    Swal.fire({
      title: 'Remover item do carrinho?',
      text: "Confirme para remover!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, quero remover'
    }).then(function (result) {
      if (result.isConfirmed) {
        e.preventDefault();
        var product_id = $(_this).closest(".cartpage").find('.product_id').val();
        var data = {
          '_token': $('input[name=_token]').val(),
          "product_id": product_id
        };
        $.ajax({
          url: '/delete-from-cart',
          type: 'DELETE',
          data: data,
          success: function success(response) {
            Swal.fire('Item Removido!', 'Produto removido do carrinho com sucesso!', 'success');
            window.location.reload();
          },
          error: function error(response) {
            Swal.fire('Ops, algo deu errado!', 'Infelizmente houve um problema e não conseguimos remover este item do carrinho', 'error');
            window.location.reload();
          }
        });
      }
    });
  });
}); // Clear Cart Data

$('.clearcart').click(function (e) {
  Swal.fire({
    title: 'Remover itens do carrinho?',
    text: "Você irá remover todos os itens do seu carrinho!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, quero remover'
  }).then(function (result) {
    if (result.isConfirmed) {
      e.preventDefault();
      $.ajax({
        url: '/clear-cart',
        type: 'GET',
        success: function success(response) {
          Swal.fire('Itens Removido!', 'Itens removido do carrinho com sucesso!', 'success');
          window.location.reload();
        },
        error: function error(response) {
          Swal.fire('Ops, algo deu errado!', 'Infelizmente houve um problema e não conseguimos remover os itens do carrinho', 'error');
          window.location.reload();
        }
      });
    }
  });
}); // funções para habilitar campos de endereços de entrega

function verificaentrega() {
  if ($('#enderecocadastro').prop("checked")) {
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

$('input[name=entrega]').on('change', function (ev) {
  verificaentrega();
});

function verificaEntregaId() {
  if ($('#outroendereconovo').prop("checked")) {
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

$('input[name=entrega_id]').on('change', function (ev) {
  verificaEntregaId();
}); // habilita ou desabilita icone e input de troco

$('input[name=formapagamento]').on('change', function (ev) {
  if ($('#dinheiro').prop("checked")) {
    $("#trocopara").prop("disabled", false);
  } else {
    $("#trocopara").prop("disabled", true);
    $("#trocopara").val("0,00");
  }
});
$(document).ready(function () {
  verificaentrega();
  verificaEntregaId();
  $('#novo-telefone').mask('(00) 00000-0000');
  $('#trocopara').mask("#.##0.00", {
    reverse: true
  }); // $("#trocopara").val("0,00");
});

/***/ }),

/***/ 17:
/*!*******************************************************!*\
  !*** multi ./resources/js/catalogo/scripts-custom.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\pediu\resources\js\catalogo\scripts-custom.js */"./resources/js/catalogo/scripts-custom.js");


/***/ })

/******/ });
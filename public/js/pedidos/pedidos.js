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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pedidos/pedidos.js":
/*!*****************************************!*\
  !*** ./resources/js/pedidos/pedidos.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#delete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var contid = button.data('contid');
  var modal = $(this);
  modal.find('.modal-body #contid').val(contid);
});
$('#baixar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var contid = button.data('contid');
  var total = button.data('total');
  var entregador = button.data('entregador');
  var modal = $(this);
  modal.find('.modal-body #contid').val(contid);
  modal.find('.modal-body #entregador').text(entregador);
  modal.find('.modal-body #vltotal').text(total);
  modal.find('.modal-body #valorpedido').val(total);
});
$('#mudarStatus').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var pedidoid = button.data('pedidoid');
  var statusentrega = button.data('statusentrega');
  var entregador_id = button.data('entregador_id');
  var valortroco = button.data('valortroco');
  var troco = button.data('troco');
  var modal = $(this);
  modal.find('.modal-body .troco-modal-input').val(valortroco);
  modal.find('.modal-body #statusentrega').val(statusentrega).change();
  modal.find('.modal-body #entregador_id').val(entregador_id).change();
  modal.find('.modal-body #pedidoid').val(pedidoid);

  if (troco == 0) {
    modal.find('.modal-body .troco-modal').css("display", "none");
  } else {
    modal.find('.modal-body .troco-modal').css("display", "block");
    $("input[name='troco']").mask("#.##0.00", {
      reverse: true
    });
  }
});
$(document).ready(function () {
  $('.js-example-basic-single').select2();
  $('.js-example-products').select2();
  $('.js-example-basic-multiple').select2();
  $(document).on('keydown', function (event) {
    if (event.keyCode == 113) {
      $('.js-example-basic-single').select2('open');
    }
  });
}); // ==========================================================================================
// tela de pedidos, responsável por criar os steeps

$(document).ready(function () {
  var current_fs, next_fs, previous_fs; //fieldsets

  var opacity;
  $(".next").click(function () {
    current_fs = $(this).parent();
    next_fs = $(this).parent().next(); //Add Class Active

    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active"); //show the next fieldset

    next_fs.show(); //hide the current fieldset with style

    current_fs.animate({
      opacity: 0
    }, {
      step: function step(now) {
        // for making fielset appear animation
        opacity = 1 - now;
        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        next_fs.css({
          'opacity': opacity
        });
      },
      duration: 600
    });
  });
  $(".previous").click(function () {
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev(); //Remove class active

    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active"); //show the previous fieldset

    previous_fs.show(); //hide the current fieldset with style

    current_fs.animate({
      opacity: 0
    }, {
      step: function step(now) {
        // for making fielset appear animation
        opacity = 1 - now;
        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        previous_fs.css({
          'opacity': opacity
        });
      },
      duration: 600
    });
  });
  $('.radio-group .radio').click(function () {
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
  });
  $(".submit").click(function () {
    return false;
  });
});

/***/ }),

/***/ 7:
/*!***********************************************!*\
  !*** multi ./resources/js/pedidos/pedidos.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! X:\Laragon\www\Pediu\resources\js\pedidos\pedidos.js */"./resources/js/pedidos/pedidos.js");


/***/ })

/******/ });
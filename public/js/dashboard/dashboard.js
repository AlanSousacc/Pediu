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
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/dashboard/dashboard.js":
/*!*********************************************!*\
  !*** ./resources/js/dashboard/dashboard.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var canvasbalcao = $('#pedidosbalcaomes');
  var balcaoMes = new Chart(canvasbalcao);
  var canvasloja = $('#pedidoslojames');
  var lojames = new Chart(canvasloja); // gráfico mensal de vendas do balcão

  function graficobalcao(dia, totaldia) {
    balcaoMes.destroy();
    balcaoMes = new Chart(canvasbalcao, {
      type: 'bar',
      data: {
        labels: totaldia,
        datasets: [{
          label: 'Total do dia: R$',
          data: dia,
          barThickness: 100,
          borderRadius: 5,
          backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
          borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: false,
            title: {
              display: true,
              text: 'Total por Dia R$'
            }
          },
          x: {
            display: true,
            title: {
              display: true,
              text: 'Dias'
            }
          }
        },
        interaction: {
          intersect: false,
          mode: 'index'
        },
        plugins: {
          tooltip: {
            usePointStyle: true
          }
        }
      }
    });
  } // gráfico mensal de vendas da loja


  function graficoloja(dia, totaldia) {
    lojames.destroy();
    lojames = new Chart(canvasloja, {
      type: 'bar',
      data: {
        labels: totaldia,
        datasets: [{
          label: 'Total do dia: R$',
          data: dia,
          barThickness: 100,
          borderRadius: 5,
          backgroundColor: ['rgba(100, 99, 132, 0.2)', 'rgba(54, 255, 70, 0.2)', 'rgba(255, 206, 100, 0.2)', 'rgba(99, 192, 145, 0.2)', 'rgba(153, 102, 158, 0.2)', 'rgba(255, 159, 64, 0.2)'],
          borderColor: ['rgba(155, 99, 132, 1)', 'rgba(54, 255, 100, 1)', 'rgba(255, 206, 86, 1)', 'rgba(154, 192, 192, 1)', 'rgba(176, 80, 158, 1)', 'rgba(153, 102, 255, 1)'],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: false,
            title: {
              display: true,
              text: 'Total por Dia R$'
            }
          },
          x: {
            display: true,
            title: {
              display: true,
              text: 'Dias'
            }
          }
        },
        interaction: {
          intersect: false,
          mode: 'index'
        },
        plugins: {
          tooltip: {
            usePointStyle: true
          }
        }
      }
    });
  }

  $('document').ready(function () {
    vendasBalcaoMensal();
    vendasLojaMensal();
  });

  function vendasBalcaoMensal() {
    $.ajax({
      url: '/vendas-balcao-mensal',
      type: 'get',
      dataType: "json",
      success: function success(data) {
        // console.log(data)
        var totaldia = [];
        var dia = [];

        for (var i in data) {
          totaldia.push(data[i].totaldia);
          dia.push(data[i].dia);
        }

        graficobalcao(totaldia, dia);
      },
      error: function error(data) {
        alert('error');
      }
    });
  }

  function vendasLojaMensal() {
    $.ajax({
      url: '/vendas-loja-mensal',
      type: 'get',
      dataType: "json",
      success: function success(data) {
        // console.log(data)
        var totaldia = [];
        var dia = [];

        for (var i in data) {
          totaldia.push(data[i].totaldia);
          dia.push(data[i].dia);
        }

        graficoloja(totaldia, dia);
      },
      error: function error(data) {
        alert('error');
      }
    });
  }
});

/***/ }),

/***/ 10:
/*!***************************************************!*\
  !*** multi ./resources/js/dashboard/dashboard.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\pediu\resources\js\dashboard\dashboard.js */"./resources/js/dashboard/dashboard.js");


/***/ })

/******/ });
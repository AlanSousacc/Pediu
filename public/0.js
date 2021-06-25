(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./resources/js/vue/components/modalinseriritem.js":
/*!*********************************************************!*\
  !*** ./resources/js/vue/components/modalinseriritem.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var modalinseriritem = {
  template: "\n  <div>\n    <b-button id=\"show-btn\" @click=\"showModal\">Open Modal</b-button>\n    <b-button id=\"toggle-btn\" @click=\"toggleModal\">Toggle Modal</b-button>\n\n    <b-modal ref=\"my-modal\" hide-footer title=\"Using Component Methods\">\n      <div class=\"d-block text-center\">\n        <h3>Hello From My Modal!</h3>\n      </div>\n      <b-button class=\"mt-3\" variant=\"outline-danger\" block @click=\"hideModal\">Close Me</b-button>\n      <b-button class=\"mt-2\" variant=\"outline-warning\" block @click=\"toggleModal\">Toggle Me</b-button>\n    </b-modal>\n  </div>\n  ",
  methods: {
    showModal: function showModal() {
      this.$refs['my-modal'].show();
    },
    hideModal: function hideModal() {
      this.$refs['my-modal'].hide();
    },
    toggleModal: function toggleModal() {
      // We pass the ID of the button that we want to return focus to
      // when the modal has hidden
      this.$refs['my-modal'].toggle('#toggle-btn');
    }
  }
};

/***/ })

}]);
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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/user/registeruser.js":
/*!*******************************************!*\
  !*** ./resources/js/user/registeruser.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperty(obj, key, value) {
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }

  return obj;
}

var submit = false;
var submitConfirmation = false;
$(document).on('click', '.btn-register-user', function (e) {
  e.preventDefault();
  submit = true;

  if (validateFields() == 0) {
    $.ajax({
      url: '/register-user',
      method: 'POST',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        firstName: $('#txtFirstName').val(),
        lastName: $('#txtLastName').val(),
        middleName: $('#txtMiddleName').val(),
        email: $('#txtEmail').val(),
        mobilePhone: $('#txtMobilePhone').val(),
        password: $('#txtPassword').val(),
        retypePassword: $('#txtRetypePassword').val(),
        ref_link: $('#txtRefLink').val()
      },
      beforeSend: function beforeSend() {
        Swal.fire({
          text: 'Please wait while registering your account in Pure Happilife ...',
          allowOutsideClick: false,
          showConfirmButton: false,
          willOpen: function willOpen() {
            Swal.showLoading();
          }
        });
      },
      success: function success(response) {
        if (response.success == true) {
          $('#register-successfully').removeClass("hide");
          $('#registration-form-content').hide("fast");
          $('.btn-resend-password').hide("fast");
          var timeleft = 90;
          var downloadTimer = setInterval(function () {
            if (timeleft <= 0) {
              clearInterval(downloadTimer);
              document.getElementById("countdown").innerHTML = "Did'nt receive the code even you check your spam email ? Try to resend a new password.";
              $('.btn-resend-password').show("fast");
            } else {
              document.getElementById("countdown").innerHTML = "If you did'nt again receive the code try again in " + timeleft + " seconds remaining";
            }

            timeleft -= 1;
          }, 1000);
          Swal.fire({
            icon: 'success',
            text: response.userMessage
          });
        }

        if (response.success == false) {
          Swal.fire({
            icon: 'error',
            text: response.userMessage
          });
        }
      },
      error: function error() {
        Swal.fire({
          icon: 'success',
          text: 'Something went wrong!'
        });
      }
    });
  }
});
$(document).on('click', '.btn-continue-authentication', function (e) {
  e.preventDefault();
  validateConfirmationFields();
  submitConfirmation = true;

  if (validateFields() == 0) {
    $.ajax({
      url: '/authenticate',
      method: 'POST',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        email: $('#txtEmail').val(),
        password: $('#txtConfirmationCode').val()
      },
      beforeSend: function beforeSend() {
        var _Swal$fire;

        Swal.fire((_Swal$fire = {
          text: 'Please wait while registering your account in Pure Happilife ...',
          allowOutsideClick: false,
          showConfirmButton: false
        }, _defineProperty(_Swal$fire, "showConfirmButton", false), _defineProperty(_Swal$fire, "willOpen", function willOpen() {
          Swal.showLoading();
        }), _Swal$fire));
      },
      success: function success(response) {
        if (response.success == true) {
          Swal.fire({
            icon: 'success',
            text: response.userMessage
          });
          location.reload();
        }

        if (response.success == false) {
          Swal.fire({
            icon: 'error',
            text: response.userMessage
          });
        }
      }
    });
  }
});
$(document).on('click', '.btn-resend-password', function (e) {
  e.preventDefault();
  $.ajax({
    url: '/reset-passcode',
    method: 'POST',
    data: {
      _token: $('meta[name="csrf-token"]').attr('content'),
      email: $('#txtEmail').val()
    },
    beforeSend: function beforeSend() {
      Swal.fire({
        text: 'Please wait while sending the new password to your email ...',
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: function willOpen() {
          Swal.showLoading();
        }
      });
    },
    success: function success(response) {
      if (response.success == true) {
        $('.btn-resend-password').hide("fast");
        var timeleft = 90;
        var downloadTimer = setInterval(function () {
          if (timeleft <= 0) {
            clearInterval(downloadTimer);
            document.getElementById("countdown").innerHTML = "Did'nt receive the code even you check your spam email ? Try to resend a new password.";
            $('.btn-resend-password').show("fast");
          } else {
            document.getElementById("countdown").innerHTML = "If you did'nt again receive the code try again in " + timeleft + " seconds remaining";
          }

          timeleft -= 1;
        }, 1000);
        Swal.fire({
          icon: 'success',
          text: response.userMessage
        });
      }

      if (response.success == false) {
        Swal.fire({
          icon: 'error',
          text: response.userMessage
        });
      }
    }
  });
});
$(document).on('keyup', '.validate-field-confirmation', function () {
  if (submit != false) {
    validateConfirmationFields();
  }
});
$(document).on('keyup', '.validate-field-confirmation', function () {
  if (submitConfirmation != false) {
    validateConfirmationFields();
  }
});

function validateFields() {
  for (var i = 0, countError = 0, inputFieldsCount = $('.validate-field').length; i < inputFieldsCount; i++) {
    var errorMessage = document.getElementsByClassName("validate-field")[i].getAttribute("error-message");

    if (document.getElementsByClassName("validate-field")[i].value == "") {
      countError += 1;
      document.getElementsByClassName("validate-field")[i].style.border = "1px solid red";
      document.getElementsByClassName("error-message")[i].textContent = errorMessage;
    } else {
      document.getElementsByClassName("validate-field")[i].style.border = "1px solid #e3e3e3";
      document.getElementsByClassName("error-message")[i].textContent = "";
    }
  }

  return countError;
}

function validateConfirmationFields() {
  for (var i = 0, countError = 0, inputFieldsCount = $('.validate-field-confirmation').length; i < inputFieldsCount; i++) {
    var errorMessage = document.getElementsByClassName("validate-field-confirmation")[i].getAttribute("error-message-confirmation");

    if (document.getElementsByClassName("validate-field-confirmation")[i].value == "") {
      countError += 1;
      document.getElementsByClassName("validate-field-confirmation")[i].style.border = "1px solid red";
      document.getElementsByClassName("error-message-confirmation")[i].textContent = errorMessage;
    } else {
      document.getElementsByClassName("validate-field-confirmation")[i].style.border = "1px solid #e3e3e3";
      document.getElementsByClassName("error-message-confirmation")[i].textContent = "";
    }
  }

  return countError;
}

/***/ }),

/***/ 1:
/*!*************************************************!*\
  !*** multi ./resources/js/user/registeruser.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Rhom\Desktop\purefolder\purehappilife\resources\js\user\registeruser.js */"./resources/js/user/registeruser.js");


/***/ })

/******/ });
window.addEventListener('load', function() {

    'use strict';
  
    function validateForm(e) {

      let usernameValidationIcon = document.getElementById('usernameIcon');
      let passwordValidationIcon = document.getElementById('passwordIcon');

  
      let formValidatedFlag = true;

      // username field
      if ( /^\w{5,20}$/.test(usernameText.value) ) {
        usernameValidationIcon.classList.remove("w3-text-red", "fa", "fa-close");
        usernameValidationIcon.classList.add("w3-text-green", "fa", "fa-check");
      } else {
        formValidatedFlag = false;
        usernameValidationIcon.classList.remove("w3-text-green", "fa", "fa-check");
        usernameValidationIcon.classList.add("w3-text-red", "fa", "fa-close");
      }
  
      // password field
      if ( /^\w{5,30}$/.test(passwordText.value) ) {
        passwordValidationIcon.classList.remove("w3-text-red", "fa", "fa-close");
        passwordValidationIcon.classList.add("w3-text-green", "fa", "fa-check");
      } else {
        formValidatedFlag = false;
        passwordValidationIcon.classList.remove("w3-text-green", "fa", "fa-check");
        passwordValidationIcon.classList.add("w3-text-red", "fa", "fa-close");
      }
  
      if ( formValidatedFlag === false ) {
        e.preventDefault();
      }
    }
  
  
    // Cache the form fields to be validated.
    let form = this.document.getElementById('validationForm');
    let usernameText = this.document.getElementById('usernameText');
    let passwordText = this.document.getElementById('passwordText');

    // Register the form's submit event
    form.addEventListener('submit', function(e) {
      validateForm(e);
    });
  });
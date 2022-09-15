window.addEventListener('load', function() {

    'use strict';
  
    function validateForm(e) {

      let usernameValidationIcon = document.getElementById('usernameIcon');
      let passwordValidationIcon = document.getElementById('passwordIcon');
      let firstNameValidationIcon = document.getElementById('firstNameIcon');
      let lastNameValidationIcon = document.getElementById('lastNameIcon');

  
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
  
      //first name field
      if ( /^[A-Z]+$/i.test(firstNameText.value) ) {
        firstNameValidationIcon.classList.remove("w3-text-red", "fa", "fa-close");
        firstNameValidationIcon.classList.add("w3-text-green", "fa", "fa-check");
      } else {
        formValidatedFlag = false;
        firstNameValidationIcon.classList.remove("w3-text-green", "fa", "fa-check");
        firstNameValidationIcon.classList.add("w3-text-red", "fa", "fa-close");
      }

      //last name field
      if ( /^[A-Z]+$/i.test(lastNameText.value) ) {
        lastNameValidationIcon.classList.remove("w3-text-red", "fa", "fa-close");
        lastNameValidationIcon.classList.add("w3-text-green", "fa", "fa-check");
      } else {
        formValidatedFlag = false;
        lastNameValidationIcon.classList.remove("w3-text-green", "fa", "fa-check");
        lastNameValidationIcon.classList.add("w3-text-red", "fa", "fa-close");
      }



      if ( formValidatedFlag === false ) {
        e.preventDefault();
      }
    }
  
  
    // Cache the form fields to be validated.
    let form = this.document.getElementById('validationForm');
    let usernameText = this.document.getElementById('usernameText');
    let passwordText = this.document.getElementById('passwordText');
    let firstNameText = this.document.getElementById('firstNameText');
    let lastNameText = this.document.getElementById('lastNameText');

    // Register the form's submit event
    form.addEventListener('submit', function(e) {
      validateForm(e);
    });
  });
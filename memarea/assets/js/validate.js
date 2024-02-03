/**
* PHP Email Form Validation - v3.0
* URL: https://bootstrapmade.com/php-email-form/
* Author: BootstrapMade.com
*/
(function () {
  "use strict";

  let forms = document.querySelectorAll('.php-login-form');

  forms.forEach( function(e) {
    e.addEventListener('submit', function(event) {
    event.preventDefault();
/*
    if( $('#captcha_in').val() != $('#captcha').text() ) {
        //$('#captcha_in').validationEngine('showPrompt', 'Invalid captcha', 'load');
        $('.error-message').innerHTML='Captcha Error!!!';
        return false;
    }
*/
      
//console.log(this);
      let thisForm = this;

      let action = thisForm.getAttribute('action');
      let recaptcha = thisForm.getAttribute('data-recaptcha-site-key');
      console.log(recaptcha);
      if( ! action ) {
        displayError(thisForm, 'The form action property is not set!')
        return;
      }
      thisForm.querySelector('.loading').classList.add('d-block');
      thisForm.querySelector('.error-message').classList.remove('d-block');
      thisForm.querySelector('.sent-message').classList.remove('d-block');

      let formData = new FormData( thisForm );

      if ( recaptcha ) {
        if(typeof grecaptcha !== "undefined" ) {
          grecaptcha.ready(function() {
            try {
              grecaptcha.execute(recaptcha, {action: 'php_login_form_submit'})
              .then(token => {
                formData.set('recaptcha-response', token);
                php_login_form_submit(thisForm, action, formData);
              })
            } catch(error) {
              displayError(thisForm, error)
            }
          });
        } else {
          displayError(thisForm, 'The reCaptcha javascript API url is not loaded!')
        }
      } else {
  //      console.log(formData);
        php_login_form_submit(thisForm, action, formData);
      }
    });
  });

  function php_login_form_submit(thisForm, action, formData) {
    fetch(action, {
      method: 'POST',
      body: formData,
      headers: {'X-Requested-With': 'XMLHttpRequest'}
    })
    .then(response => {
      if( response.ok ) {
        //console.log(response);
        return response.text()
      } else {
        throw new Error(`${response.status} ${response.statusText} ${response.url}`); 
      }
    })
    .then(data => {
      thisForm.querySelector('.loading').classList.remove('d-block');
      //console.log(data);
      if (data.trim() == 'OK') {
        thisForm.querySelector('.sent-message').classList.add('d-block');
        thisForm.reset(); 
       window.location.replace("profile.php");
       //  thisForm.querySelector(".sent-message").classList.fadeOut(2500);
      /*   var element = document.querySelector('.sent-message');
  element.classList.add('fadeout');
  setTimeout(function() {
    element.style.display = 'none';
        thisForm.querySelector('.sent-message').classList.remove('d-block');
  }, 1500);*/
      
      } else {
        throw new Error(data ? data : 'Form submission failed and no error message returned from: ' + action); 
     
         var element = document.querySelector('.error-message');
  element.classList.add('fadeout');
  setTimeout(function() {
    element.style.display = 'none';
        thisForm.querySelector('.error-message').classList.remove('d-block');
  }, 1500);



      }
    })
    .catch((error) => {
      displayError(thisForm, error);
    });
  }

  function displayError(thisForm, error) {
    thisForm.querySelector('.loading').classList.remove('d-block');
    thisForm.querySelector('.error-message').innerHTML = error;
    thisForm.querySelector('.error-message').classList.add('d-block');
    //thisForm.querySelector('.error-message').fadeOut(2500);
  }

})();

jQuery(document).ready(function() {

    //Custom script to load popups based on different scenarios
    jQuery('.open-popup').on('click', function(e) {
        e.preventDefault();

        var popupId = jQuery(this).data('popup-id');
        // AJAX request to get popup content
        jQuery.ajax({
            url : KapcoPublicScript.ajaxurl,
            type: 'POST',
            data: {
                action: 'kapco_load_popup_content',
                popup_id: popupId
            },

            success: function(response) {
                // Open Magnific Popup with the response content
                jQuery.magnificPopup.open({
                    items: {
                        src: jQuery('<div class="mfp-content">' + response + '</div>'),
                        type: 'inline'
                    },
                    closeBtnInside: true // Ensure close button is inside the popup
                });

                jQuery('#agree-terms').on('click', function(e) {
                    e.preventDefault();
            
                    jQuery.magnificPopup.close();
                    // Close the popup and check the checkbox when the button is clicked
                    jQuery("#tc").prop('checked', true);
                });
            }
        });
    });


    //Custom code to validate and Register user using ajax
    jQuery('#customer-registration-form').on('submit', function(e) {
        // Prevent default form submission
        e.preventDefault();
        var validation_status =  validateRegistrationFields();   
        var recaptchaResponse = grecaptcha.getResponse();
        var password_strength =  getPasswordStrength( jQuery("#reg_pass").val() );
        if( validation_status && password_strength === 'strong' ) {
            var password_compare  =  comparePassword( jQuery("#reg_pass").val() , jQuery("#reg_confirm_password").val());
            // Get the reCAPTCHA response token
            var recaptchaResponse = grecaptcha.getResponse();
            if( password_compare ) {
                jQuery.ajax({
                    type:"POST",
                    url : KapcoPublicScript.ajaxurl,
                    data : {
                      action: "kapco_user_registration",
                      username:jQuery("#reg_username").val(),
                      customer_id:jQuery("#reg_userid").val(),
                      email:jQuery("#reg_email").val(),
                      password:jQuery("#reg_pass").val(),
                      recaptcha_response: recaptchaResponse
                    },
                    success : function(response) {
                        console.log(response);
                        if ( response.msg != ""  ) {
                            jQuery(".status-message").html(response.msg);
                        }

                        if( response.reg_status == 1 ) {
                            setTimeout(function() {
                                // Redirect to the specified URL
                                window.location.href = response.redirect;
                            }, 2000);
                        }
                    }
                  });
            } else {
                jQuery("#reg_confirm_password").next('.error').text('Passwords do not match.').show();
            }
        }
    });

    jQuery('#reg_pass').on('keyup', function() {
        var password = jQuery(this).val();
        var strength = getPasswordStrength(password);
        
        // Get the strength bar and the text element
        var strengthBar = jQuery('#strength-bar');
        var strengthText = jQuery('#password-strength-text');

        // Update the progress bar and text based on the strength
        if (strength === 'weak') {
            strengthBar.css('width', '33%').css('background-color', 'red');
            strengthText.text('Weak').css('color', 'red');
        } else if (strength === 'medium') {
            strengthBar.css('width', '66%').css('background-color', 'yellow');
            strengthText.text('Medium').css('color', 'yellow');
        } else if (strength === 'strong') {
            strengthBar.css('width', '100%').css('background-color', 'green');
            strengthText.text('Strong').css('color', 'green');
        } else {
            strengthBar.css('width', '0').css('background-color', '#e0e0e0');
            strengthText.text('');
        }
    });

    //compare password if both of them are equal
    function comparePassword( password , confirmPassword ) {
        var confPassword = true;
        if (password !== confirmPassword) {
          confPassword = false;
        }
        return confPassword;
    }

    // Function to check the password strength
    function getPasswordStrength( password ) {
        var strength = 'weak';
        var regexWeak = /(?=.{6,})/; // At least 6 characters
        var regexMedium = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/; // At least one uppercase letter, one lowercase letter, and one number
        var regexStrong = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/; // At least one uppercase letter, one lowercase letter, one number, and one special character
        if (regexStrong.test(password)) {
            strength = 'strong';
        } else if (regexMedium.test(password)) {
            strength = 'medium';
        } else if (regexWeak.test(password)) {
            strength = 'weak';
        }
        return strength;
    }

    function validateRegistrationFields(){
        isValid = true;
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var numberPattern = /^\d+$/;
        var recaptchaResponse = grecaptcha.getResponse();

        jQuery('.validate-field').each(function() {
            jQuery(this).next('.error').text('');
            var input_value = jQuery(this).val().trim();
            if (input_value === '') {
                isValid = false;
                jQuery(this).next('.error').text('This field is required.').show();
            } if(  jQuery(this).attr('type') == 'email' ) {
                if (!emailPattern.test(input_value) && input_value !== '') {
                    isValid = false;
                    jQuery(this).next('.error').text('Please enter a valid email address.').show();
                } 
            } 
        });     

        if ( recaptchaResponse.length == 0 ) {
            isValid = false;
            jQuery(".g-recaptcha").next('.error').text('Please verify that you are not a robot.').show();
        }


        /*if (!numberPattern.test(jQuery('#reg_userid').val()) && jQuery('#reg_userid').val() !== '') {  
               isValid = false;
               jQuery('#reg_userid').next('.error').text('Customer Id should only have numbers.').show();
        }*/
        return isValid;
    }
});
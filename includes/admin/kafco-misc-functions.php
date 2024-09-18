<?php

/**
 *  Function for display translated string
*/
function kafco_plugin_str_display($string){
    if ( function_exists( 'pll__' ) ) {
        return pll__($string);
    }
    return $string; 
}

/* Custom functionality to register user on signup */
function kapco_plugin_user_registration() {

    $registration_status = 0;
    $validation_flag = false; 
    $customer_flag = false;
    $status_message = "";
    $thankyou_redirect = get_the_permalink(pll_get_post(get_page_by_path( 'sign-up-success' )->ID));


    //$recaptcha_response = sanitize_text_field($_POST['recaptcha_response']);
    $recaptcha_response = $_POST['recaptcha_response'];
   // echo $recaptcha_response;
    $secret_key = KAFCO_GRECAPTCHA_SECRET_KEY;
    $recaptchaResponse = $_POST['recaptcha_response'];
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secret_key,
        'response' => $recaptchaResponse
    ];

   
    // Initialize CURL
    $ch = curl_init($url);

    // Configure CURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Execute CURL and get the response
    $result = curl_exec($ch);
    curl_close($ch);

    // Decode the response
    $responseData = json_decode($result);

    

    if (isset($_POST['recaptcha_response'])) {
          if ($responseData->success) {
            if ( !empty( $_POST['username'] ) && !empty( $_POST['customer_id'] ) && !empty( $_POST['email'] ) && !empty( $_POST['password'] ) ) {
              //Custom code to validate for duplicate user id
              $user_query = new WP_User_Query( array( 'role' => 'Subscriber' ) );
              if ( ! empty( $user_query->get_results() ) ) {
                foreach ( $user_query->get_results() as $key => $user ) {
                  $available_id = get_user_meta( $user->data->ID , 'custom_user_id' , true )  ;             
                  if( !empty( $available_id ) && $available_id === $_POST['customer_id'] ) {
                    $customer_flag = true;
                    break;
                  }
                
                }
              }
  
              if ( email_exists($_POST['email']) && username_exists( $_POST['username'] ) ) {
                $status_message = "Username and Email both already exists.";
                $validation_flag = true;  
                $registration_status = 3;
              } else if ( email_exists($user_email) ) {
                $status_message = "Email already exists. Please use a different email address.";
                $validation_flag = true;
                $registration_status = 3;
              } else if ( username_exists($username) ) {
                $status_message = "Username already exists. Please use a different username.";
                $validation_flag = true;
                $registration_status = 3;
              } else if( $customer_flag ) {
                $status_message = "Customer Id already in use. Please select another one.";
                $validation_flag = true;
                $registration_status = 3;
              }
  
            // Create the user
            if( !$validation_flag ) {
                $user_id = wp_create_user($_POST['username'], $_POST['password'], $_POST['email']);
                if (is_wp_error($user_id)) {
                    $status_message = "An error occurred: " . $user_id->get_error_message();
                    $registration_status = 2;
                } else {
                  $user = new WP_User($user_id);
                  $user->set_role('subscriber');
                  update_user_meta($user_id, 'custom_user_id', $_POST['customer_id']);
                  $status_message =  "User successfully registered.";
                  $registration_status = 1;
              } 
           }
          } else {
              $status_message = "reCAPTCHA verification failed."; 
              $registration_status = 2;      
          }  
    } else {
      $status_message = "reCAPTCHA response missing."; 
      $registration_status = 2;
    }   

    }  

    wp_send_json(array('msg' => $status_message, 'reg_status' => $registration_status, 'redirect' => $thankyou_redirect));

}
add_action('wp_ajax_nopriv_kapco_user_registration', 'kapco_plugin_user_registration');
add_action('wp_ajax_kapco_user_registration', 'kapco_plugin_user_registration');

/* Custom code to load content and popup based on link click dynamically */
function kapco_load_popup_content() {
  if ( ! isset( $_POST['popup_id'] ) ) {
      wp_send_json_error( 'Invalid request' );
      return;
  }

  $popup_id = sanitize_text_field( $_POST['popup_id'] );

  // Prepare content based on the popup ID
  switch ( $popup_id ) {
      case 'tc-login':
          $content = '<div id="popup1-content">
             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><br/>
             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><br/>
             <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
             <a class="btn-login accept-terms" id="agree-terms" href="#">I Accept the Terms of Use and Conditions</a>
          </div>';
          break;
      case 'popup2':
          $content = '<div id="popup2-content">This is the content for Popup 2.</div>';
          break;
      case 'popup3':
          $content = '<div id="popup3-content">This is the content for Popup 3.</div>';
          break;
      default:
          $content = '<div class="mfp-hide">No content found.</div>';
          break;
  }

  echo do_shortcode( $content );
  wp_die();
}

add_action( 'wp_ajax_kapco_load_popup_content', 'kapco_load_popup_content' );
add_action( 'wp_ajax_nopriv_kapco_load_popup_content', 'kapco_load_popup_content' );


/* Custom functionality to customize html of Forgot password page */
function custom_lost_password_form() {
  
  ?>
  <div class="notice notice-info message"><p>Please enter your username or email address. You will receive an email message with instructions on how to reset your password.</p></div>
  <form name="lostpasswordform" id="lostpasswordform" action="https://medevword.com/wp-login.php?action=lostpassword" method="post">
			<p>
				<label for="user_login">Username or Email Address</label>
				<input type="text" name="user_login" id="user_login" class="input" value="" size="20" autocapitalize="off" autocomplete="username" required="required">
			</p>
						<input type="hidden" name="redirect_to" value="">
			<p class="submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Get New Password">
			</p>
		</form>
  <?php
}

//add_action('login_form_lostpassword', 'custom_lost_password_form');
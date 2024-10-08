<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Shortcode Class
 *
 * Manage Shortcodes in the website
 *
 * @package Kafco
 * @since 1.0.0
 */

class Kafco_Shortcodes {

	public $scripts;

	//class constructor
	function __construct() {
		
	}

	/**
	 * Shortcode displaying login form for customer login
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */

	function kafco_custom_login_form( $atts ) {
	  ob_start();

      $atts = shortcode_atts([
        'redirect' => home_url(), // Redirect to home page by default
    ], $atts, 'kafco_login_form');

    $dashboard_url = get_the_permalink(pll_get_post(get_page_by_path( 'contract-summary' )->ID));

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_form_submit'])) {
        $username = sanitize_text_field($_POST['log']);
        $password = sanitize_text_field($_POST['pwd']);
        $terms_agreed = isset($_POST['tc']) ? true : false;
        $error_message = ''; 
        if (!$terms_agreed) {
            //echo '<p class="error">You must agree to the terms and conditions.</p>';
            $error_message = 'You must agree to the terms and conditions.';
        } else {
            $creds = [
                'user_login' => $username,
                'user_password' => $password,
            ];
            $user = wp_signon($creds, false);
            if (is_wp_error($user)) {
                // Display error message
                //echo '<p class="error">' . $user->get_error_message() . '</p>';
                $error_message = 'Invalid username or password.';
            } else {
                // Redirect to the specified URL or current page
                wp_redirect($dashboard_url);
                exit;
            }
        }
    }    
   if(!is_user_logged_in()) {
 	 ?> 
     <div class="page-wrapper">
        <div class="login-sec">
            <div class="login-image">
                <img src="<?php echo KAFCO_INC_URL . '/images/login-img.png' ?>">
            </div>
            <div class="login-info">
                <h4><?php echo kafco_plugin_str_display('Customer Login'); ?></h4>
                <?php if(!empty($error_message)) { ?> 
                    <p class="error"><?php echo $error_message; ?></p>
                <?php } ?>    
                <form id="custom-login-form" method="post" action="">
                    <div class="form-group">
                        <label><?php echo kafco_plugin_str_display('Username'); ?></label>
                        <input type="text" name="log" id="user_login" value="" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo kafco_plugin_str_display('Password'); ?></label>   
                        <input type="password" name="pwd" id="user_pass" required>
                    </div>
                    <div class="form-group">
                        <!--<button type="button" class="btn-login">Login</button>-->
                        <input type="submit" class="btn-login" name="login_form_submit" value="<?php echo kafco_plugin_str_display('Login'); ?>">
                        <!--<input type="submit"/>-->
                    </div>
                    <div class="form-cb">
                        <!--<input type="checkbox" name="terms_agreed" id="terms_agreed" value="1" required>-->
                        <input type="checkbox" name="tc" id="tc">
                        <label for="tc"> <?php echo kafco_plugin_str_display('I Accept the'); ?> <a class="open-popup" data-popup-id="tc-login" href="#"><?php echo kafco_plugin_str_display('Terms of Use and Conditions'); ?></a> </label>
                    </div>
                </form>    
            </div>
        </div>
     </div>
     <?php } else { 

        if( !isset( $_GET['action'] ) || $_GET['action'] != 'edit' ) {
            wp_redirect($dashboard_url);
        } 
      ?> 
        
     <?php }
      return ob_get_clean();
	}

    /**
	 * Shortcode displaying login form for customer login
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */

    public function kapco_customer_registration_form() {
        ob_start();
  
        $dashboard_url = get_the_permalink(pll_get_post(get_page_by_path( 'customer-login' )->ID));
  
    /*if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_form_submit'])) {
        
          $username = sanitize_text_field($_POST['user_login']);
          $custom_user_id  = sanitize_text_field($_POST['user_id']);
          $user_password  = sanitize_text_field($_POST['reg_pwd']);
          $user_confirm_password = sanitize_text_field($_POST['reg_confirm_pwd']);
          $user_email = sanitize_text_field($_POST['reg_email']);
          $validation_flag = false;
          if ( username_exists($username) ) {
            $error_message = "Username already exists. Please choose a different username.";
            $validation_flag = true;  
          } else if ( email_exists($user_email) ) {
            $error_message = "Email already exists. Please use a different email address.";
            $validation_flag = true;
          } else if ( email_exists($user_email) && username_exists($username) ) {
            $error_message = "Username and Email both already exists.";
            $validation_flag = true;
          } elseif (strcmp($user_password, $user_confirm_password) !== 0 ) {
            $error_message = "Passwords do not match. Please try again.";
            $validation_flag = true;
          }

         // Create the user
         if(!$validation_flag) {
            $user_id = wp_create_user($username, $password, $user_email);
            if (is_wp_error($user_id)) {
               $error_message = "An error occurred: " . $user_id->get_error_message();
            } else {
               $user = new WP_User($user_id);
               $user->set_role('subscriber');
               update_user_meta($user_id, 'custom_user_id', $custom_user_id);
               $error_message =  "User successfully registered.";
               sleep(4);
               wp_redirect($dashboard_url);
           }
         }
    }*/    
     if(!is_user_logged_in()) {
        ?> 
       <div class="page-wrapper">
          <div class="login-sec">
              <div class="login-image">
                  <img src="<?php echo KAFCO_INC_URL . '/images/login-img.png' ?>">
              </div>
              <div class="login-info">
                  <h4><?php echo kafco_plugin_str_display('Customer Registration'); ?></h4>
                  <p class="status-message"></p>    
                  <form id="customer-registration-form" method="post" action="">
                      <div class="form-group">
                          <label><?php echo kafco_plugin_str_display('Username'); ?></label>
                          <input type="text" class="validate-field" name="user_reg" id="reg_username" value="" >
                          <span class="error"></span>
                      </div>
                      <div class="form-group">
                          <label><?php echo kafco_plugin_str_display('Customer Id'); ?></label>
                          <input type="text" class="validate-field" name="user_id" id="reg_userid" value="">
                          <span class="error"></span>
                      </div>
                      <div class="form-group">
                          <label><?php echo kafco_plugin_str_display('Email'); ?></label>
                          <input type="email" class="validate-field" name="reg_email" id="reg_email" value="">
                          <span class="error"></span>
                      </div>
                      
                      <div class="form-group">
                          <label><?php echo kafco_plugin_str_display('Password'); ?></label>   
                          <input type="password" class="validate-field" name="reg_pwd" id="reg_pass">
                          <span class="error"></span>
                          <div id="strength-bar" class="strength-bar"></div>
                          <div class="strength-wrap">
                           <span id="password-strength-text"></span>
                          </div>
                          
                          <span class="password-policies">( 1 lowercase &amp; 1 uppercase , 1 number (0-9) and 1 Special Character (!@#$%^&*) ,  )</span>
                      </div>      
                      <div class="form-group">
                          <label><?php echo kafco_plugin_str_display('Confirm Password'); ?></label>   
                          <input type="password" class="validate-field"  name="reg_confirm_pwd" id="reg_confirm_password">
                          <span class="error"></span>
                      </div>

                      <div class="form-group">
                          <!--<button type="button" class="btn-login">Login</button>-->
                          <div class="g-recaptcha" data-sitekey="<?php echo KAFCO_GRECAPTCHA_SITE_KEY; ?>"></div>
                          <span class="error"></span>
                          <input type="submit" class="btn-login" name="register_form_submit" value="<?php echo kafco_plugin_str_display('Register'); ?>">
                          <!--<input type="submit"/>-->
                      </div>
                      <!--<a href="https://medevword.com/wp-login.php?action=lostpassword">Lost your password?</a>-->
                  </form>    
              </div>
          </div>
       </div>
       <?php    
          }
        return ob_get_clean();
      }

      
    public function kapco_customer_forgot_password_form(){

        ob_start();
    ?>
    <form name="lostpasswordform" id="lostpasswordform" action="<?php echo esc_url( network_site_url( 'wp-login.php?action=lostpassword', 'login_post' ) ); ?>" method="post">
        <p class="custom-lost-password-text">Enter your email address to reset your password:</p>
        <p>
            <label for="user_login"><?php _e( 'Email Address' ); ?><br />
            <input type="text" name="user_login" id="user_login" class="input" value="" size="20" /></label>
        </p>
        <?php do_action( 'lostpassword_form' ); ?>
        <p class="submit">
            <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Reset Password' ); ?>" />
        </p>
    </form>
    <?php
    return ob_get_clean();    

    }


    /**
	 * Shortcode displaying contract statement of the customer
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */

     public function kafco_customer_contract_statement(){

        ob_start();
        /* Move user to login page if user is not signed in */ 
        $kafco_login_url = get_the_permalink(pll_get_post(get_page_by_path( 'customer-login' )->ID));
        if(!is_user_logged_in()) {
            wp_redirect($kafco_login_url);
            exit;
        } 
        ?>
        <div class="page-wrapper">
            <div class="sidenav-sec">
                <?php 
                    include_once( KAFCO_INC_DIR.'/public/class-kafco-common-sidebar.php' );
                    if (class_exists('Kafco_Sidebar')) {
                    $kafco_sidebar = new Kafco_Sidebar();
                    $kafco_sidebar->kafco_common_sidebar();
                } ?>
                <div class="sidenav-content">
                    <div class="table-title">
                        <h3><?php echo kafco_plugin_str_display('Contract Summary'); ?></h3>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?php echo kafco_plugin_str_display('Agreement Date'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Invoice/ Payment Currency'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Credit Days'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Credit Terms'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Defuel/ Re-issue Facility'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Contract Renewal Date'); ?></th>
                            </tr>
                            <tr>
                                <td>26-02-2023</td>
                                <td><?php echo kafco_plugin_str_display('KWD/USD'); ?></td>
                                <td>0/7/15/21/30</td>
                                <td><?php echo kafco_plugin_str_display('Open / BG / Deposit /Prepayment'); ?></td>
                                <td><?php echo kafco_plugin_str_display('Entitle as per contract /No'); ?></td>
                                <td><?php echo kafco_plugin_str_display('Last Date / Auto-renewable'); ?></td>
                            </tr>
                            <tr>
                                <td>26-02-2023</td>
                                <td><?php echo kafco_plugin_str_display('KWD/USD'); ?></td>
                                <td>0/7/15/21/30</td>
                                <td><?php echo kafco_plugin_str_display('Open / BG / Deposit /Prepayment'); ?></td>
                                <td><?php echo kafco_plugin_str_display('Entitle as per contract /No'); ?></td>
                                <td><?php echo kafco_plugin_str_display('Last Date / Auto-renewable'); ?></td>
                            </tr>
                            <tr>
                                <td>26-02-2023</td>
                                <td><?php echo kafco_plugin_str_display('KWD/USD'); ?></td>
                                <td>0/7/15/21/30</td>
                                <td><?php echo kafco_plugin_str_display('Open / BG / Deposit /Prepayment'); ?></td>
                                <td><?php echo kafco_plugin_str_display('Entitle as per contract /No'); ?></td>
                                <td><?php echo kafco_plugin_str_display('Last Date / Auto-renewable'); ?></td>
                            </tr>
                            <tr>
                                <td>26-02-2023</td>
                                <td><?php echo kafco_plugin_str_display('KWD/USD'); ?></td>
                                <td>0/7/15/21/30</td>
                                <td><?php echo kafco_plugin_str_display('Open / BG / Deposit /Prepayment'); ?></td>
                                <td><?php echo kafco_plugin_str_display('Entitle as per contract /No'); ?></td>
                                <td><?php echo kafco_plugin_str_display('Last Date / Auto-renewable'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
     }

     /**
	 * Shortcode displaying Statement of account of the customer
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */

     public function kafco_statement_of_account(){

        ob_start();
        $this->redirect_user_to_login();
        ?>
        <div class="page-wrapper">
            <div class="sidenav-sec">
                <?php 
                    include_once( KAFCO_INC_DIR.'/public/class-kafco-common-sidebar.php' );
                    if (class_exists('Kafco_Sidebar')) {
                    $kafco_sidebar = new Kafco_Sidebar();
                    $kafco_sidebar->kafco_common_sidebar();
                } ?>
                <div class="sidenav-content">
                    <div class="table-title">
                        <h3><?php echo kafco_plugin_str_display('Statement Of Account'); ?></h3>
                    </div>
                    <div class="table-filters">
                        <div class="form-group">
                            <label><?php echo kafco_plugin_str_display('Date from'); ?></label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><?php echo kafco_plugin_str_display('Date to'); ?></label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><?php echo kafco_plugin_str_display('Currency'); ?></label>
                            <select class="form-control">
                                <option></option>
                                <option></option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-green"><?php echo kafco_plugin_str_display('Apply Filter'); ?></button>
                        <button type="button" class="btn btn-cf"><img src="<?php echo KAFCO_INC_URL . '/images/undo-arrow.svg' ?>"><?php echo kafco_plugin_str_display('Clear Filter'); ?></button>
                    </div>
                    <div class="table-info">
                        <div class="tbl-info-c">
                            <img src="<?php echo KAFCO_INC_URL . '/images/ti-1.svg' ?>">
                            <p><label><?php echo kafco_plugin_str_display('Customer'); ?></label> <?php echo kafco_plugin_str_display('Yousef Ali Syed'); ?></p>
                        </div>
                        <div class="tbl-info-c">
                            <img src="<?php echo KAFCO_INC_URL . '/images/ti-2.svg' ?>">
                            <p><label><?php echo kafco_plugin_str_display('Opening Balance'); ?>:</label> 0000</p>
                        </div>
                        <div class="tbl-info-c">
                            <img src="<?php echo KAFCO_INC_URL . '/images/ti-3.svg' ?>">
                            <p><label><?php echo kafco_plugin_str_display('Closing Balance'); ?>:</label> 576576.000</p>
                        </div>
                        <div class="tbl-info-c">
                            <img src="<?php echo KAFCO_INC_URL . '/images/ti-4.svg' ?>">
                            <p><label><?php echo kafco_plugin_str_display('Statement Date from'); ?></label> 01/01/2023</p>
                        </div>
                        <div class="tbl-info-c">
                            <img src="<?php echo KAFCO_INC_URL . '/images/ti-4.svg' ?>">
                            <p><label><?php echo kafco_plugin_str_display('Statement From Until'); ?></label> 07/01/2023</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?php echo kafco_plugin_str_display('Serial'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Debit Note No'); ?></th>
                                <th><?php echo kafco_plugin_str_display('GL Date'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Type'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Currency'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Debit'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Credit'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Running Balance'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Comments'); ?></th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>26/06/23-313</td>
                                <td><?php echo kafco_plugin_str_display('16-jul-23'); ?></td>
                                <td><?php echo kafco_plugin_str_display('NBK Bank Transfer'); ?></td>
                                <td><?php echo kafco_plugin_str_display('KWD'); ?></td>
                                <td>0</td>
                                <td>15,000.00</td>
                                <td>15,000.00</td>
                                <td><?php echo kafco_plugin_str_display('On Account'); ?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>26/06/23-313</td>
                                <td><?php echo kafco_plugin_str_display('16-jul-23'); ?></td>
                                <td><?php echo kafco_plugin_str_display('NBK Bank Transfer'); ?></td>
                                <td><?php echo kafco_plugin_str_display('KWD'); ?></td>
                                <td>0</td>
                                <td>15,000.00</td>
                                <td>15,000.00</td>
                                <td><?php echo kafco_plugin_str_display('On Account'); ?></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>26/06/23-313</td>
                                <td><?php echo kafco_plugin_str_display('16-jul-23'); ?></td>
                                <td><?php echo kafco_plugin_str_display('NBK Bank Transfer'); ?></td>
                                <td><?php echo kafco_plugin_str_display('KWD'); ?></td>
                                <td>0</td>
                                <td>15,000.00</td>
                                <td>15,000.00</td>
                                <td><?php echo kafco_plugin_str_display('On Account'); ?></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>26/06/23-313</td>
                                <td><?php echo kafco_plugin_str_display('16-jul-23'); ?></td>
                                <td><?php echo kafco_plugin_str_display('NBK Bank Transfer'); ?></td>
                                <td><?php echo kafco_plugin_str_display('KWD'); ?></td>
                                <td>0</td>
                                <td>15,000.00</td>
                                <td>15,000.00</td>
                                <td><?php echo kafco_plugin_str_display('On Account'); ?></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>26/06/23-313</td>
                                <td><?php echo kafco_plugin_str_display('16-jul-23'); ?></td>
                                <td><?php echo kafco_plugin_str_display('NBK Bank Transfer'); ?></td>
                                <td><?php echo kafco_plugin_str_display('KWD'); ?></td>
                                <td>0</td>
                                <td>15,000.00</td>
                                <td>15,000.00</td>
                                <td><?php echo kafco_plugin_str_display('On Account'); ?></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>26/06/23-313</td>
                                <td><?php echo kafco_plugin_str_display('16-jul-23'); ?></td>
                                <td><?php echo kafco_plugin_str_display('NBK Bank Transfer'); ?></td>
                                <td><?php echo kafco_plugin_str_display('KWD'); ?></td>
                                <td>0</td>
                                <td>15,000.00</td>
                                <td>15,000.00</td>
                                <td><?php echo kafco_plugin_str_display('On Account'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-bal-info">
                        <p><?php echo kafco_plugin_str_display('Total Credit'); ?> <span>6,705.16.<?php echo kafco_plugin_str_display('KWD'); ?></span></p>
                        <p><?php echo kafco_plugin_str_display('Total Running Balance'); ?><span>6,705.16.<?php echo kafco_plugin_str_display('KWD'); ?></span></p>
                    </div>
                    <h5 class="table-head"><?php echo kafco_plugin_str_display('Summary'); ?> </h5>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?php echo kafco_plugin_str_display('Serial'); ?></th>
                                <th><?php echo kafco_plugin_str_display('Customer Name'); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><?php echo kafco_plugin_str_display('16-jul-23'); ?></td>
                                <td><?php echo kafco_plugin_str_display('KWD'); ?></td>
                                <td>-4829.000</td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-bal-info">
                        <p><?php echo kafco_plugin_str_display('Total Balance'); ?> <span>-4829.000.<?php echo kafco_plugin_str_display('KWD'); ?></span></p>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-outline-green"><img src="<?php echo KAFCO_INC_URL . '/images/pdf.svg' ?>"> <?php echo kafco_plugin_str_display('Download'); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
     }
	

     /**
	 * Shortcode displaying Missing fuel ticket requests
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */

     public function kafco_missing_fuel_ticket_requests(){

        ob_start(); 
        $this->redirect_user_to_login();
        ?>
        <div class="page-wrapper">
            <div class="sidenav-sec">
                <?php 
                    include_once( KAFCO_INC_DIR.'/public/class-kafco-common-sidebar.php' );
                    if (class_exists('Kafco_Sidebar')) {
                    $kafco_sidebar = new Kafco_Sidebar();
                    $kafco_sidebar->kafco_common_sidebar();
                } ?>
                <div class="sidenav-content">
                    <div class="table-title">
                        <h3><?php echo kafco_plugin_str_display('Missing Fuel Ticket Request'); ?></h3>
                    </div>
                    <div class="form-sec">
                        <p><?php echo kafco_plugin_str_display('Please provide the following details'); ?></p>
                        <div class="row-flex">
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Date of Uplift'); ?></label>
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Flight Number'); ?></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Flight Registration Number'); ?></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Airlines/Customer Name'); ?></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Fuel Release Referance Number'); ?></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-green"><?php echo kafco_plugin_str_display('Submit Request'); ?></button>
                            </div>
                        </div>
                        <div class="form-info-sec">
                            <img src="<?php echo KAFCO_INC_URL . '/images/information-icon.svg' ?>">
                            <p><?php echo kafco_plugin_str_display('Note: Above request will be forwarded to Ops. Department and C.C to Sales & Customer Sales'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
     }


     /**
	 * Shortcode displaying Complaints list
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */

     public function kafco_complaints_list(){
        ob_start();
        $this->redirect_user_to_login(); ?>
        <div class="page-wrapper">
            <div class="sidenav-sec">
                <?php 
                    include_once( KAFCO_INC_DIR.'/public/class-kafco-common-sidebar.php' );
                    if (class_exists('Kafco_Sidebar')) {
                    $kafco_sidebar = new Kafco_Sidebar();
                    $kafco_sidebar->kafco_common_sidebar();
                } ?>
                <div class="sidenav-content">
                    <div class="table-title">
                        <h3><?php echo kafco_plugin_str_display('Complaints'); ?></h3>
                    </div>
                    <div class="form-sec">
                        <p><?php echo kafco_plugin_str_display('Please provide the following details'); ?></p>
                        <div class="row-flex">
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Name'); ?> <span>*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Email'); ?> <span>*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Job Title'); ?></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Company'); ?></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Phone'); ?> <span>*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Country'); ?></label>
                                    <select class="form-control">
                                        <option></option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Mobile'); ?> </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Subject'); ?> <span>*</span></label>
                                    <select class="form-control">
                                        <option><?php echo kafco_plugin_str_display('Sales related complaint'); ?></option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo kafco_plugin_str_display('Message'); ?> <span>*</span></label>
                                    <textarea class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-green"><?php echo kafco_plugin_str_display('Submit Request'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
     }

     /**
	 * Shortcode displaying Complaints list
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */
    public function kapco_fuel_upliftment_summary() {

        ob_start();
        $this->redirect_user_to_login();
        ?>
            <div class="page-wrapper">
            <div class="sidenav-sec">
                <?php 
                    include_once( KAFCO_INC_DIR.'/public/class-kafco-common-sidebar.php' );
                        if (class_exists('Kafco_Sidebar')) {
                            $kafco_sidebar = new Kafco_Sidebar();
                            $kafco_sidebar->kafco_common_sidebar();
                        } ?>
                    <div class="sidenav-content">
                        <div class="table-title">
                            <h3><?php echo kafco_plugin_str_display('Fuel Uplift Summary'); ?></h3>
                        </div>
                        <div class="table-filters">
                            <div class="form-group">
                                <label><?php echo kafco_plugin_str_display('Date from'); ?></label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label><?php echo kafco_plugin_str_display('Date to'); ?></label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label><?php echo kafco_plugin_str_display('Currency'); ?></label>
                                <select class="form-control">
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-green"><?php echo kafco_plugin_str_display('Apply Filter'); ?></button>
                            <button type="button" class="btn btn-cf"><img src="<?php echo KAFCO_INC_URL . '/images/undo-arrow.svg' ?>"><?php echo kafco_plugin_str_display('Clear Filter'); ?></button>
                        </div>
                        <div class="table-info">
                            <div class="tbl-info-c">
                            <img src="<?php echo KAFCO_INC_URL . '/images/ti-1.svg' ?>">
                                <p><label><?php echo kafco_plugin_str_display('Customer'); ?></label> Yousef Ali Syed</p>
                            </div>
                            <div class="tbl-info-c">
                               <img src="<?php echo KAFCO_INC_URL . '/images/ti-4.svg' ?>">
                                <p><label><?php echo kafco_plugin_str_display('Statement Date from'); ?></label> 01/01/2023</p>
                            </div>
                            <div class="tbl-info-c">
                                <img src="<?php echo KAFCO_INC_URL . '/images/ti-4.svg' ?>">
                                <p><label><?php echo kafco_plugin_str_display('Statement From Until'); ?></label> 07/01/2023</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <th><?php echo kafco_plugin_str_display('Date of Uplift'); ?></th>
                                    <th><?php echo kafco_plugin_str_display('Fuel Ticket No.'); ?></th>
                                    <th><?php echo kafco_plugin_str_display('Quantity(Ltrs)'); ?></th>
                                    <th><?php echo kafco_plugin_str_display('Flight#'); ?></th>
                                    <th><?php echo kafco_plugin_str_display('Aircraft Reg.#'); ?></th>

                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>26/06/23-313</td>
                                    <td>16-jul-23</td>
                                    <td>NBK Bank Transfer</td>
                                    <td>KWD</td>

                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>26/06/23-313</td>
                                    <td>16-jul-23</td>
                                    <td>NBK Bank Transfer</td>
                                    <td>KWD</td>

                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>26/06/23-313</td>
                                    <td>16-jul-23</td>
                                    <td>NBK Bank Transfer</td>
                                    <td>KWD</td>

                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>26/06/23-313</td>
                                    <td>16-jul-23</td>
                                    <td>NBK Bank Transfer</td>
                                    <td>KWD</td>

                                </tr>
                            </table>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-outline-green"><img src="<?php echo KAFCO_INC_URL . '/images/pdf.svg' ?>"> Download</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        return ob_get_clean();
    }

    /**
	 * Shortcode to display fuel prices
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */

    public function kapco_fuel_prices_details() {

        ob_start(); 
        $this->redirect_user_to_login();
        ?>
             <div class="page-wrapper">
                <div class="sidenav-sec">
                    <?php 
                        include_once( KAFCO_INC_DIR.'/public/class-kafco-common-sidebar.php' );
                            if (class_exists('Kafco_Sidebar')) {
                                $kafco_sidebar = new Kafco_Sidebar();
                                $kafco_sidebar->kafco_common_sidebar();
                            } ?>
                        <div class="sidenav-content">
                            <div class="table-title">
                                <h3><?php echo kafco_plugin_str_display('Fuel Prices'); ?></h3>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <tr>
                                        <th><?php echo kafco_plugin_str_display('Fuel Price Effective Date (dd/mm/yyyy)'); ?></th>
                                        <th><?php echo kafco_plugin_str_display('Valid Until Date (dd/mm/yyyy)'); ?></th>
                                        <th><?php echo kafco_plugin_str_display('Fils/Ltr'); ?></th>
                                        <th><?php echo kafco_plugin_str_display('USC/USG'); ?></th>
                                        <th><?php echo kafco_plugin_str_display('Exchange Rate'); ?></th>
                                    </tr>
                                    <tr>
                                        <td>26-02-2023</td>
                                        <td>KWD/USD</td>
                                        <td>0/7/15/21/30</td>
                                        <td>Open / BG / Deposit /Prepayment</td>
                                        <td>Entitle as per contract /No</td>
                                    </tr>
                                    <tr>
                                        <td>26-02-2023</td>
                                        <td>KWD/USD</td>
                                        <td>0/7/15/21/30</td>
                                        <td>Open / BG / Deposit /Prepayment</td>
                                        <td>Entitle as per contract /No</td>
                                    </tr>
                                    <tr>
                                        <td>26-02-2023</td>
                                        <td>KWD/USD</td>
                                        <td>0/7/15/21/30</td>
                                        <td>Open / BG / Deposit /Prepayment</td>
                                        <td>Entitle as per contract /No</td>
                                    </tr>
                                    <tr>
                                        <td>26-02-2023</td>
                                        <td>KWD/USD</td>
                                        <td>0/7/15/21/30</td>
                                        <td>Open / BG / Deposit /Prepayment</td>
                                        <td>Entitle as per contract /No</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-outline-green"><img src="<?php echo KAFCO_INC_URL . '/images/pdf.svg' ?>"> Download</button>
                            </div>
                        </div>   
                </div>
            </div>
        
        <?php
        return ob_get_clean();

    }

     /**
	 * Shortcode to display status
	 *
	 * @package Kafco
	 * @since 1.0.0
	*/

    public function kapco_fuel_status_details() {
        ob_start();
        $this->redirect_user_to_login();
        ?>
        <div class="page-wrapper">
                <div class="sidenav-sec">
                    <?php 
                        include_once( KAFCO_INC_DIR.'/public/class-kafco-common-sidebar.php' );
                            if (class_exists('Kafco_Sidebar')) {
                                $kafco_sidebar = new Kafco_Sidebar();
                                $kafco_sidebar->kafco_common_sidebar();
                            } ?>
                        <div class="sidenav-content">
                            <div class="table-title">
                                 <h3><?php echo kafco_plugin_str_display('Status'); ?></h3>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <tr>
                                        <th><?php echo kafco_plugin_str_display('Invoice #'); ?></th>
                                        <th><?php echo kafco_plugin_str_display('Date of Issue'); ?></th>
                                        <th><?php echo kafco_plugin_str_display('Due Date'); ?></th>
                                        <th><?php echo kafco_plugin_str_display('Invoice Amount'); ?></th>
                                        <th><?php echo kafco_plugin_str_display('Status'); ?></th>
                                    </tr>
                                    <tr>
                                        <td>26-02-2023</td>
                                        <td>KWD/USD</td>
                                        <td>0/7/15/21/30</td>
                                        <td>Open / BG / Deposit /Prepayment</td>
                                        <td>Entitle as per contract /No</td>
                                    </tr>
                                    <tr>
                                        <td>26-02-2023</td>
                                        <td>KWD/USD</td>
                                        <td>0/7/15/21/30</td>
                                        <td>Open / BG / Deposit /Prepayment</td>
                                        <td>Entitle as per contract /No</td>
                                    </tr>
                                    <tr>
                                        <td>26-02-2023</td>
                                        <td>KWD/USD</td>
                                        <td>0/7/15/21/30</td>
                                        <td>Open / BG / Deposit /Prepayment</td>
                                        <td>Entitle as per contract /No</td>
                                    </tr>
                                    <tr>
                                        <td>26-02-2023</td>
                                        <td>KWD/USD</td>
                                        <td>0/7/15/21/30</td>
                                        <td>Open / BG / Deposit /Prepayment</td>
                                        <td>Entitle as per contract /No</td>
                                    </tr>
                                </table>
                            </div>
                        </div>   
                </div>
            </div>
        <?php
        return ob_get_clean();
    }

    public function kapco_satisfactory_survey() {
        ob_start();
        $this->redirect_user_to_login();
        ?>
        <div class="page-wrapper">
                <div class="sidenav-sec">
                    <?php 
                        include_once( KAFCO_INC_DIR.'/public/class-kafco-common-sidebar.php' );
                            if (class_exists('Kafco_Sidebar')) {
                                $kafco_sidebar = new Kafco_Sidebar();
                                $kafco_sidebar->kafco_common_sidebar();
                            } ?>
                        <div class="sidenav-content">
                <div class="table-title">
                    <h3><?php echo kafco_plugin_str_display('Satisfaction Survey'); ?></h3>
                </div>
                <div class="survey-cards">
                    <a href="https://medevword.com/commercial-satisfaction-survey-fy-2024-25/" class="survey-card">
                        <img src="<?php echo KAFCO_INC_URL . '/images/survey.png' ?>" alt="Commercial Satisfaction">
                        <p><?php echo kafco_plugin_str_display('Commercial Satisfaction Survey'); ?> FY-2024/25</p>
                    </a>
                    <a href="#" class="survey-card">
                    <img src="<?php echo KAFCO_INC_URL . '/images/engineering.png' ?>" alt="Operational Satisfaction">
                        <p><?php echo kafco_plugin_str_display('Operational Satisfaction Survey'); ?> FY-2024/25</p>
                    </a>
                </div>
            </div>  
                </div>
            </div>
        <?php
        return ob_get_clean();
    }

    public function kapco_commercial_survey() {
        ob_start();
        $this->redirect_user_to_login();
        ?>
        <div class="page-wrapper">
                <div class="sidenav-sec">
                    <?php 
                        include_once( KAFCO_INC_DIR.'/public/class-kafco-common-sidebar.php' );
                            if (class_exists('Kafco_Sidebar')) {
                                $kafco_sidebar = new Kafco_Sidebar();
                                $kafco_sidebar->kafco_common_sidebar();
                            } ?>
                        <div class="sidenav-content">
                        <div class="sidenav-content">
                <div class="table-title">
                    <h3>Commercial Satisfaction
                        Survey FY-2024/25</h3>
                </div>
                <div class="survey-container">
                    <p class="form-par">How satisfied are you with the following:</p>
                    <div class="survey-form">
                    <?php echo FrmFormsController::get_form_shortcode( array( 'id' => 5 ) ); ?>
                        <!-- <div class="form-header">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-radio-container">
                            <div>
                                <p class="form-radio-number"> 1</p>
                            </div>
                            <p class="form-radio-question">Clarity and simplicity of our contract terms and conditions &
                                contracting procedures</p>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="very-satisfied" name="satisfaction1" value="very-satisfied"
                                        checked>
                                    <label for="very-satisfied">Very Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="satisfied" name="satisfaction1" value="satisfied">
                                    <label for="satisfied">Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="partially-satisfied" name="satisfaction1"
                                        value="partially-satisfied">
                                    <label for="partially-satisfied">Partially Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="unsatisfied" name="satisfaction1" value="unsatisfied">
                                    <label for="unsatisfied">Unsatisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="neutral" name="satisfaction1" value="neutral">
                                    <label for="neutral">Neutral</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-radio-container">
                            <div>
                                <p class="form-radio-number"> 2</p>
                            </div>
                            <p class="form-radio-question"> Timely notification of price changess</p>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="very-satisfied" name="satisfaction2" value="very-satisfied"
                                        checked>
                                    <label for="very-satisfied">Very Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="satisfied" name="satisfaction2" value="satisfied">
                                    <label for="satisfied">Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="partially-satisfied" name="satisfaction2"
                                        value="partially-satisfied">
                                    <label for="partially-satisfied">Partially Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="unsatisfied" name="satisfaction2" value="unsatisfied">
                                    <label for="unsatisfied">Unsatisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="neutral" name="satisfaction2" value="neutral">
                                    <label for="neutral">Neutral</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-radio-container">
                            <div>
                                <p class="form-radio-number"> 3</p>
                            </div>
                            <p class="form-radio-question"> Timely receipt of our invoices and accuracy</p>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="very-satisfied" name="satisfaction3" value="very-satisfied"
                                        checked>
                                    <label for="very-satisfied">Very Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="satisfied" name="satisfaction3" value="satisfied">
                                    <label for="satisfied">Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="partially-satisfied" name="satisfaction3"
                                        value="partially-satisfied">
                                    <label for="partially-satisfied">Partially Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="unsatisfied" name="satisfaction3" value="unsatisfied">
                                    <label for="unsatisfied">Unsatisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="neutral" name="satisfaction3" value="neutral">
                                    <label for="neutral">Neutral</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-radio-container">
                            <div>
                                <p class="form-radio-number"> 4</p>
                            </div>
                            <p class="form-radio-question"> Attentiveness to customer complaints</p>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="very-satisfied" name="satisfaction4" value="very-satisfied"
                                        checked>
                                    <label for="very-satisfied">Very Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="satisfied" name="satisfaction4" value="satisfied">
                                    <label for="satisfied">Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="partially-satisfied" name="satisfaction4"
                                        value="partially-satisfied">
                                    <label for="partially-satisfied">Partially Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="unsatisfied" name="satisfaction4" value="unsatisfied">
                                    <label for="unsatisfied">Unsatisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="neutral" name="satisfaction4" value="neutral">
                                    <label for="neutral">Neutral</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-radio-container">
                            <div>
                                <p class="form-radio-number"> 5</p>
                            </div>
                            <p class="form-radio-question"> Effectiveness of the complaints follow-up</p>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="very-satisfied" name="satisfaction5" value="very-satisfied"
                                        checked>
                                    <label for="very-satisfied">Very Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="satisfied" name="satisfaction5" value="satisfied">
                                    <label for="satisfied">Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="partially-satisfied" name="partially-satisfaction5"
                                        value="partially-satisfied">
                                    <label for="partially-satisfied">Partially Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="unsatisfied" name="satisfaction5" value="unsatisfied">
                                    <label for="unsatisfied">Unsatisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="neutral" name="satisfaction5" value="neutral">
                                    <label for="neutral">Neutral</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-radio-container">
                            <div>
                                <p class="form-radio-number"> 6</p>
                            </div>
                            <p class="form-radio-question"> Thinking specifically of KAFCO, how would you rate your
                                overall experiance</p>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="very-satisfied" name="satisfaction6" value="very-satisfied"
                                        checked>
                                    <label for="very-satisfied">Very Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="satisfied" name="satisfaction6" value="satisfied">
                                    <label for="satisfied">Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="partially-satisfied" name="satisfaction6"
                                        value="partially-satisfied">
                                    <label for="partially-satisfied">Partially Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="unsatisfied" name="satisfaction6" value="unsatisfied">
                                    <label for="unsatisfied">Unsatisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="neutral" name="satisfaction6" value="neutral">
                                    <label for="neutral">Neutral</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-radio-container">
                            <div>
                                <p class="form-radio-number"> 7</p>
                            </div>
                            <p class="form-radio-question"> Improvement Please provide any suggestion or recommendation
                                to improve our fueling Operations</p>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="very-satisfied" name="satisfaction7" value="very-satisfied"
                                        checked>
                                    <label for="very-satisfied">Very Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="satisfied" name="satisfaction7" value="satisfied">
                                    <label for="satisfied">Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="partially-satisfied" name="satisfaction7"
                                        value="partially-satisfied">
                                    <label for="partially-satisfied">Partially Satisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="unsatisfied" name="satisfaction7" value="unsatisfied">
                                    <label for="unsatisfied">Unsatisfied</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="neutral" name="satisfaction7" value="neutral">
                                    <label for="neutral">Neutral</label>
                                </div>
                            </div>
                        </div>
                        <div class="textarea-container">
                            <div class="form-group">
                                <label>Improvement Please provide any suggestion or recommendation to improve our
                                    Fueling Operations </label>
                                <textarea class="form-control" rows="4"
                                    placeholder="Any Comment or Suggestion"></textarea>
                            </div>
                        </div>
                        <div class="form-btns">

                            <button type="button" class="btn btn-green submit-btn">Submit</button>
                            <button type="button" class="btn btn-green reversed-btn">Reset</button>

                        </div> -->
                    </div>

                </div>
            </div>
                
            </div>  
                </div>
            </div>
        <?php
        return ob_get_clean();
    }

    public function redirect_user_to_login(){
        $kafco_login_url = get_the_permalink(pll_get_post(get_page_by_path( 'customer-login' )->ID));
        if(!is_user_logged_in()) {
           wp_redirect($kafco_login_url);
           exit;
        } 
    }

    /** 
* Redirects the user to the custom "Forgot your password?" page instead of 
* wp-login.php?action=lostpassword. 
*/
public function redirect_to_custom_lostpassword() {
    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
        if ( is_user_logged_in() ) {
            $this->redirect_logged_in_user();
            exit;
        }
        wp_redirect( home_url( 'forgot-password' ) );
        exit;
    }
}

/** 
* A shortcode for rendering the form used to initiate the password reset. 
* 
* @param array $attributes Shortcode attributes. 
* @param string $content The text content for shortcode. Not used. 
* 
* @return string The shortcode output 
*/
public function render_password_lost_form( $attributes, $content = null ) {
    // Parse shortcode attributes 
    ob_start();
    $default_attributes = array( 'show_title' => false );
    $attributes = shortcode_atts( $default_attributes, $attributes );
    if ( is_user_logged_in() ) {
        return __( 'You are already signed in.', 'personalize-login' );
    } else {?>
        <div id="password-lost-form" class="widecolumn">
    <?php if ( $attributes['show_title'] ) : ?>
        <h3><?php _e( 'Forgot Your Password?', 'personalize-login' ); ?></h3>
    <?php endif; ?>
    <p>
        <?php
            _e(
                "Enter your email address and we'll send you a link you can use to pick a new password.",
                'personalize_login'
            );
        ?>
    </p>
    <form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
        <p class="form-row">
            <label for="user_login"><?php _e( 'Email', 'personalize-login' ); ?>
            <input type="text" name="user_login" id="user_login">
        </p>
        <p class="lostpassword-submit">
            <input type="submit" name="submit" class="lostpassword-button"
                   value="<?php _e( 'Reset Password', 'personalize-login' ); ?>"/>
        </p>
    </form>
</div>
   <?php }
   return ob_get_clean();
}

/** 
* Initiates password reset. 
*/
public function do_password_lost() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
        $errors = retrieve_password();
        if ( is_wp_error( $errors ) ) {
            // Errors found 
            $redirect_url = home_url( 'forgot-password' );
            $redirect_url = add_query_arg( 'errors', join( ',', $errors->get_error_codes() ), $redirect_url );
        } else {
            // Email sent 
            $redirect_url = home_url( 'customer-login' );
            $redirect_url = add_query_arg( 'checkemail', 'confirm', $redirect_url );
        }
        wp_redirect( $redirect_url );
        exit;
    }
}

	/**
	 * Adding Hooks
	 *
	 * @package Kafco
     * 
	 * @since 1.0.0
	 */ 
	function add_hooks(){
		add_shortcode('kafco_login_form',array($this,'kafco_custom_login_form'));
        add_shortcode('kafco_contract_statement',array($this,'kafco_customer_contract_statement'));
        add_shortcode('kafco_statement_account',array($this,'kafco_statement_of_account'));
        add_shortcode('kafco_missing_fuel_ticket',array($this,'kafco_missing_fuel_ticket_requests'));
        add_shortcode('kafco_complaints',array($this,'kafco_complaints_list'));
        add_shortcode('kafco_fuel_upliftment',array($this,'kapco_fuel_upliftment_summary'));
        add_shortcode('kafco_fuel_prices',array($this,'kapco_fuel_prices_details'));
        add_shortcode('kafco_fuel_status',array($this,'kapco_fuel_status_details'));
        add_shortcode('kapco_satisfactory_survey',array($this,'kapco_satisfactory_survey'));
        add_shortcode('kapco_commercial_survey',array($this,'kapco_commercial_survey'));
        add_shortcode('kafco_registration_form',array($this,'kapco_customer_registration_form'));
        //add_filter('lostpassword_form',array($this,'kapco_customer_forgot_password_form'));
        add_action( 'login_form_lostpassword', array( $this, 'redirect_to_custom_lostpassword' ) );
        add_shortcode( 'custom-password-lost-form', array( $this, 'render_password_lost_form' ) );
        add_action( 'login_form_lostpassword', array( $this, 'do_password_lost' ) );
   



        
	}
}

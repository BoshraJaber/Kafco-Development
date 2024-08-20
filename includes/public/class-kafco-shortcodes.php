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
                        <label for="tc"> <?php echo kafco_plugin_str_display('I Accept the'); ?> <a href="#"><?php echo kafco_plugin_str_display('Terms of Use and Conditions'); ?></a> </label>
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
                            <h3>Fuel Uplift Summary</h3>
                        </div>
                        <div class="table-filters">
                            <div class="form-group">
                                <label>Date from</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Date to</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Currency</label>
                                <select class="form-control">
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-green">Apply Filter</button>
                            <button type="button" class="btn btn-cf"><img src="<?php echo KAFCO_INC_URL . '/images/undo-arrow.svg' ?>">Clear Filter</button>
                        </div>
                        <div class="table-info">
                            <div class="tbl-info-c">
                            <img src="<?php echo KAFCO_INC_URL . '/images/ti-1.svg' ?>">
                                <p><label>Customer</label> Yousef Ali Syed</p>
                            </div>
                            <div class="tbl-info-c">
                               <img src="<?php echo KAFCO_INC_URL . '/images/ti-4.svg' ?>">
                                <p><label>Statement Date from</label> 01/01/2023</p>
                            </div>
                            <div class="tbl-info-c">
                                <img src="<?php echo KAFCO_INC_URL . '/images/ti-4.svg' ?>">
                                <p><label>Statement From Until</label> 07/01/2023</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <th>Date of Uplift</th>
                                    <th>Fuel Ticket No.</th>
                                    <th>Quantity(Ltrs)</th>
                                    <th>Flight#</th>
                                    <th>Aircraft Reg.#</th>

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
                                <h3>Fuel Prices</h3>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <tr>
                                        <th>Fuel Price Effective Date (dd/mm/yyyy)</th>
                                        <th>Valid Until Date (dd/mm/yyyy)</th>
                                        <th>Fils/Ltr</th>
                                        <th>USC/USG</th>
                                        <th>Exchange Rate</th>
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
                                 <h3>Status</h3>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <tr>
                                        <th>Invoice #</th>
                                        <th>Date of Issue</th>
                                        <th>Due Date</th>
                                        <th>Invoice Amount</th>
                                        <th>Status</th>
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
                                 <h3>Status</h3>
                            </div>
                            <?php echo do_shortcode('[qsm quiz=1]') ?>
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
        
	}
}

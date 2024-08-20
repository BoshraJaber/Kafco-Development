<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Sidebar Class
 *
 * Manage Common Sidebar
 *
 * @package Kafco
 * @since 1.0.0
 */

class Kafco_Sidebar {

	public $scripts;

	//class constructor
	function __construct() {
		
	}

	/**
	 * Function displaying common sidebar for all pages
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */

	function kafco_common_sidebar() {
        
        $logout_url = wp_logout_url(get_the_permalink(pll_get_post(get_page_by_path( 'customer-login' )->ID)));

        
        ?> 
     <div class="sidenav-info">
        <div class="sidenav-user">
            <div class="user-img">
                <img src="<?php echo KAFCO_INC_URL . '/images/user.svg' ?>">
            </div>
            <div class="user-info">
                <h5>Yousef Abbas ali Syed </h5>
                <p>Kuwait Airways</p>
            </div>
        </div>

        <div class="sidenav">
            <a href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'contract-summary' )->ID)); ?>" <?php if(is_page('contract-summary')) echo 'class="active"'; ?>><img src="<?php echo KAFCO_INC_URL . '/images/Contract.svg'; ?>"> <?php echo kafco_plugin_str_display('Contract Terms'); ?></a>
            <a href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'status' )->ID)); ?>" <?php if(is_page('status')) echo 'class="active"'; ?>><img src="<?php echo KAFCO_INC_URL . '/images/status.svg' ?>"> <?php echo kafco_plugin_str_display('Status'); ?></a>
            <a href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'statement-account' )->ID)); ?>" <?php if(is_page('statement-account')) echo 'class="active"'; ?>><img src="<?php echo KAFCO_INC_URL . '/images/statement.svg' ?>"> <?php echo kafco_plugin_str_display('Statement Of Account'); ?></a>
            <a href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'fuel-uplift-summary' )->ID)); ?>" <?php if(is_page('fuel-uplift-summary')) echo 'class="active"'; ?>><img src="<?php echo KAFCO_INC_URL . '/images/fuel.svg' ?>"> <?php echo kafco_plugin_str_display('Fuel Uplift Summary'); ?></a>
            <a href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'fuel-prices' )->ID)); ?>" <?php if(is_page('fuel-prices')) echo 'class="active"'; ?>><img src="<?php echo KAFCO_INC_URL . '/images/fuel-prices.svg' ?>"> <?php echo kafco_plugin_str_display('Fuel Prices'); ?></a>
            <a href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'missing-fuel-ticket-request' )->ID)); ?>" <?php if(is_page('missing-fuel-ticket-request')) echo 'class="active"'; ?>><img src="<?php echo KAFCO_INC_URL . '/images/missing-fuel.svg' ?>"> <?php echo kafco_plugin_str_display('Missing Fuel Ticket Request'); ?></a>
            <a href="#"><img src="<?php echo KAFCO_INC_URL . '/images/survey.svg' ?>"> <?php echo kafco_plugin_str_display('Satisfaction Survey'); ?></a>
            <a href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'complaints' )->ID)); ?>" <?php if(is_page('complaints')) echo 'class="active"'; ?>><img src="<?php echo KAFCO_INC_URL . '/images/complaints.svg' ?>"> <?php echo kafco_plugin_str_display('Complaints'); ?></a>
            <a href="<?php echo $logout_url; ?>"><img src="<?php echo KAFCO_INC_URL . '/images/signout.svg' ?>"> <?php echo kafco_plugin_str_display('Sign out'); ?></a>
        </div>

    </div>

     <?php
	}


	/**
	 * Adding Hooks
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */ 
	function add_hooks(){
		//add_action('plugins_loaded',array($this,'kafco_common_sidebar'));
	}
}
?>
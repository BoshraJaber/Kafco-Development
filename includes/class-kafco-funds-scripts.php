<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Scripts Class
 *
 * Handles adding scripts functionality to the admin pages
 * as well as the front pages.
 *
 * @package Kafco
 * @since 1.0.0
 */

class Kafco_Scripts {

	//class constructor
	function __construct()
	{
		
	}
	
	/**
	 * Enqueue Scripts on Admin Side
	 * 
	 * @package Kafco
	 * @since 1.0.0
	 */
	public function kafco_admin_scripts(){
	
	}

	/**
	 * Enqueue Scripts on Front-side Side
	 * 
	 * @package Kafco
	 * @since 1.0.0
	 */
	
	 public function kafco_front_scripts() {

		wp_register_style('kafco-login-style', KAFCO_INC_URL . '/css/login-account.css');
		wp_register_style('kafco-sidebar-style', KAFCO_INC_URL . '/css/SideNav.css');
		if(is_page('customer-login') || is_page('contract-summary') || is_page('statement-account') || is_page('missing-fuel-ticket-request') || is_page('complaints') || is_page('status') || is_page('fuel-uplift-summary') || is_page('fuel-prices')){
			wp_enqueue_style('kafco-login-style');
			wp_enqueue_style('kafco-sidebar-style');
		}
		

		//wp_register_script('arab-funds-public-script', ARAB_FUNDS_INC_URL . '/js/arab-custom-script.js',array('jquery'),rand());
        //wp_enqueue_script('arab-funds-public-script');

		
        //$localize_scriptArgs = array();
        //$localize_scriptArgs['ajaxurl'] = admin_url('admin-ajax.php', ( is_ssl() ? 'https' : 'http'));
		//wp_localize_script('arab-funds-public-script', 'ArabFundsPublic', $localize_scriptArgs);

	 }


	/**
	 * Adding Hooks
	 *
	 * Adding hooks for the styles and scripts.
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */	
	function add_hooks(){
		
		//add admin scripts
		//add_action('admin_enqueue_scripts', array($this, 'arab_funds_admin_scripts'));
		add_action('wp_enqueue_scripts', array($this, 'kafco_front_scripts'));
	}
}
?>
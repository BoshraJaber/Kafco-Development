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

		wp_enqueue_style( 'magnific-style', KAFCO_INC_URL . '/css/magnific.min.css', array(), '1.1.0' );
		wp_register_style('kafco-login-style', KAFCO_INC_URL . '/css/login-account.css');
		wp_register_style('kafco-sidebar-style', KAFCO_INC_URL . '/css/SideNav.css');	
		wp_enqueue_style('kafco-login-style');
		wp_enqueue_style('kafco-sidebar-style');


		
		wp_enqueue_script( 'magnific-script', KAFCO_INC_URL . '/js/magnific.min.js', array('jquery'), '1.1.0', true );
		wp_register_script('kafco-public-script', KAFCO_INC_URL . '/js/custom-script.js',array('jquery'),'1.0.3');
        wp_enqueue_script('kafco-public-script');
        $localize_scriptArgs = array();
        $localize_scriptArgs['ajaxurl'] = admin_url('admin-ajax.php', ( is_ssl() ? 'https' : 'http'));
		wp_localize_script('kafco-public-script', 'KapcoPublicScript', $localize_scriptArgs);

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
<?php
/*
Plugin Name: New Kafco Development
Plugin URI:http://www.kafco.com/
Description: Custom development and enhancements of new features for Kafco
Version: 1.0.0
Author: New Kafco
Author URI: http://www.kafco.com/
*/

/**
 * Basic plugin definitions 
 * 
 * @package Kafco
 * @since 1.0.0
 */
if( !defined( 'KAFCO_DIR' ) ) {
  define( 'KAFCO_DIR', dirname( __FILE__ ) );      // Plugin dir
}
if( !defined( 'KAFCO_VERSION' ) ) {
  define( 'KAFCO_VERSION', '1.0.3' );      // Plugin Version
}
if( !defined( 'KAFCO_URL' ) ) {
  define( 'KAFCO_URL', plugin_dir_url( __FILE__ ) );   // Plugin url
}
if( !defined( 'KAFCO_INC_DIR' ) ) {
  define( 'KAFCO_INC_DIR', KAFCO_DIR.'/includes' );   // Plugin include dir
}
if( !defined( 'KAFCO_INC_URL' ) ) {
  define( 'KAFCO_INC_URL', KAFCO_URL.'includes' );    // Plugin include url
}
if( !defined( 'KAFCO_ADMIN_DIR' ) ) {
  define( 'KAFCO_ADMIN_DIR', KAFCO_INC_DIR.'/admin' );  // Plugin admin dir
}
if(!defined('KAFCO_PREFIX')) {
  define('KAFCO_PREFIX', 'kafco'); // Plugin Prefix
}
if(!defined('KAFCO_VAR_PREFIX')) {
  define('KAFCO_VAR_PREFIX', '_kafco_'); // Variable Prefix
}

/**
 * Load Text Domain
 *
 * This gets the plugin ready for translation.
 *
 * @package Kafco
 * @since 1.0.0
 */
load_plugin_textdomain( 'kafco', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/**
 * Activation Hook
 *
 * Register plugin activation hook.
 *
 * @package Kafco
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'kafco_install' );

function kafco_install(){
	
}

/**
 * Deactivation Hook
 *
 * Register plugin deactivation hook.
 *
 * @package Kafco
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'kafco_uninstall');

function kafco_uninstall(){
  
}

// Global variables
global $kafco_scripts, $kafco_admin, $kafco_shortcodes;

/*include_once( ARAB_FUNDS_ADMIN_DIR.'/arab-funds-misc-functions.php' );

// Script class handles most of script functionalities of plugin


// Admin class handles most of admin panel functionalities of plugin
include_once( ARAB_FUNDS_ADMIN_DIR.'/class-arab-funds-admin.php' );
$arab_funds_admin = new Arab_Funds_Admin();
$arab_funds_admin->add_hooks();

Shortcodes class handles all the shortcodes displayed on the front-end
*/

// Registring Post type functionality
//require_once( ARAB_FUNDS_INC_DIR.'/arab-funds-post-type.php' );
include_once( KAFCO_ADMIN_DIR.'/kafco-misc-functions.php' );

include_once( KAFCO_ADMIN_DIR.'/class-kafco-admin.php' );
$kafco_admin = new Kafco_Admin();
$kafco_admin->add_hooks();

include_once( KAFCO_INC_DIR.'/class-kafco-funds-scripts.php' );
$kafco_shortcodes = new Kafco_Scripts();
$kafco_shortcodes->add_hooks();

include_once( KAFCO_INC_DIR.'/public/class-kafco-shortcodes.php' );
$kafco_shortcodes = new Kafco_Shortcodes();
$kafco_shortcodes->add_hooks();


// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

// Custom Blocks

// Define things
define( 'ESSENTIAL_BLOCKS_FILE', __FILE__ );

require_once __DIR__ . '/autoload.php';

/**
 * Dependencies (Made by WPDeveloper)
 */
require_once __DIR__ . '/lib/style-handler/style-handler.php';

function wpdev_essential_blocks()
{
    return EssentialBlocks\Plugin::get_instance();
}

wpdev_essential_blocks();
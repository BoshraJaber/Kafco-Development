<?php
/*
Plugin Name: Kafco Development
Plugin URI:http://www.kafco.com/
Description: Custom development and enhancements of new features for Kafco
Version: 1.0.0
Author: Kafco
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
// function custom_popup_block_assets() {
//     // Register the block editor script.
//     wp_register_script(
//         'custom-popup-block-editor',
//         plugins_url('block.js', __FILE__),
//         array('wp-blocks', 'wp-element', 'wp-editor'),
//         filemtime(plugin_dir_path(__FILE__) . 'block.js')
//     );

//     // Register the block editor styles.
//     wp_register_style(
//         'custom-popup-block-editor-style',
//         plugins_url('editor.css', __FILE__),
//         array('wp-edit-blocks'),
//         filemtime(plugin_dir_path(__FILE__) . 'editor.css')
//     );

//     // Register the front-end styles.
//     wp_register_style(
//         'custom-popup-block-style',
//         plugins_url('style.css', __FILE__),
//         array(),
//         filemtime(plugin_dir_path(__FILE__) . 'style.css')
//     );

//     // Register the block type with the above scripts and styles.
//     register_block_type('custom/popup-block', array(
//         'editor_script' => 'custom-popup-block-editor',
//         'editor_style'  => 'custom-popup-block-editor-style',
//         'style'         => 'custom-popup-block-style',
//     ));
// }
// add_action('init', 'custom_popup_block_assets');


// function custom_popup_block_frontend_script() {
//     wp_enqueue_script(
//         'custom-popup-block-frontend',
//         plugins_url('frontend.js', __FILE__),
//         array('jquery'),
//         filemtime(plugin_dir_path(__FILE__) . 'frontend.js'),
//         true
//     );
// }
// add_action('wp_enqueue_scripts', 'custom_popup_block_frontend_script');



function enqueue_custom_popup_block_assets() {
    wp_enqueue_script(
        'custom-popup-block-editor-script',
        plugins_url('blocks/popup/block.js', __FILE__),
        array('wp-blocks', 'wp-element', 'wp-editor'),
        filemtime(plugin_dir_path(__FILE__) . 'blocks/popup/block.js')
    );

    wp_enqueue_style(
        'custom-popup-block-editor-style',
        plugins_url('blocks/popup/editor.css', __FILE__),
        array('wp-edit-blocks'),
        filemtime(plugin_dir_path(__FILE__) . 'blocks/popup/editor.css')
    );

    wp_enqueue_script(
        'custom-popup-block-frontend-script',
        plugins_url('blocks/popup/frontend.js', __FILE__),
        array('wp-element'),
        filemtime(plugin_dir_path(__FILE__) . 'blocks/popup/frontend.js'),
        true
    );

    wp_enqueue_style(
        'custom-popup-block-frontend-style',
        plugins_url('blocks/popup/style.css', __FILE__),
        array(),
        filemtime(plugin_dir_path(__FILE__) . 'blocks/popup/style.css')
    );
}
add_action('enqueue_block_assets', 'enqueue_custom_popup_block_assets');

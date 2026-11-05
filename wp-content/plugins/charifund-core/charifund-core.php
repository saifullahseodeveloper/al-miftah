<?php
/*
Plugin Name: Charifund Core
Plugin URI: https://themeforest.net/user/wowtheme7/portfolio
Description: Plugin to contain short codes and custom post types of the Charifund theme.
Author: Wowtheme7
Author URI: https://wowtheme7.com/
Version: 1.3.0
Text Domain: charifund-core
*/


/**
 * If this file is called directly, abort.
 * @package charifund
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Plugin directory path
 * @package charifund
 * @since 1.0.0
 */
define( 'CHARIFUND_CORE_ROOT_PATH', plugin_dir_path( __FILE__ ) );
define( 'CHARIFUND_CORE_ROOT_URL', plugin_dir_url( __FILE__ ) );
define( 'CHARIFUND_CORE_SELF_PATH', 'charifund-core/charifund-core.php' );
define( 'CHARIFUND_CORE_VERSION', '1.0.0' );
define( 'CHARIFUND_CORE_INC', CHARIFUND_CORE_ROOT_PATH .'/inc');
define( 'CHARIFUND_CORE_LIB', CHARIFUND_CORE_ROOT_PATH .'/lib');
define( 'CHARIFUND_CORE_ELEMENTOR', CHARIFUND_CORE_ROOT_PATH .'/elementor');
define( 'CHARIFUND_CORE_DEMO_IMPORT', CHARIFUND_CORE_ROOT_PATH .'/demo-import');
define( 'CHARIFUND_CORE_ADMIN', CHARIFUND_CORE_ROOT_PATH .'/admin');
define( 'CHARIFUND_CORE_ADMIN_ASSETS', CHARIFUND_CORE_ROOT_URL .'admin/assets');
define( 'CHARIFUND_CORE_WP_WIDGETS', CHARIFUND_CORE_ROOT_PATH .'/wp-widgets');
define( 'CHARIFUND_CORE_ASSETS', CHARIFUND_CORE_ROOT_URL .'assets/');
define( 'CHARIFUND_CORE_CSS', CHARIFUND_CORE_ASSETS .'css');
define( 'CHARIFUND_CORE_JS', CHARIFUND_CORE_ASSETS .'js');
define( 'CHARIFUND_CORE_IMG', CHARIFUND_CORE_ASSETS .'img');
define( 'CHARIFUND_CORE_ICONS', CHARIFUND_CORE_ROOT_PATH .'/customicon');


/**
 * Load additional helpers functions
 * @package charifund
 * @since 1.0.0
 */
if (!function_exists('charifund_core')){
	require_once CHARIFUND_CORE_INC .'/theme-core-helper-functions.php';
	if (!function_exists('charifund_core')){
		function charifund_core(){
			return class_exists('Charifund_Core_Helper_Functions') ? new Charifund_Core_Helper_Functions() : false;
		}
	}
}
//ob flash
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );


/**
 * Load Codestar Framework Functions
 * @package charifund
 * @since 1.0.0
 */
if ( !charifund_core()->is_charifund_active()) {
	if ( file_exists( CHARIFUND_CORE_ROOT_PATH . '/inc/csf-functions.php' ) ) {
		require_once CHARIFUND_CORE_ROOT_PATH . '/inc/csf-functions.php';
	}
}



/**
 * Core Plugin Init
 * @package charifund
 * @since 1.0.0
 */
if ( file_exists( CHARIFUND_CORE_ROOT_PATH . '/inc/theme-core-init.php' ) ) {
	require_once CHARIFUND_CORE_ROOT_PATH . '/inc/theme-core-init.php';
}
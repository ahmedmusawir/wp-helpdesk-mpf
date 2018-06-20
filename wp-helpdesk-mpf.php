<?php 

/**
 *
 * Plugin Name: MPF WP Helpdesk 
 * Plugin URI:	https://htmlfivedev.com 
 * Description: Display WP API Sample Code at the bottom of a site for development
 * Version: 	1.0
 * Author URI: 	https://www.linkedin.com/in/ahmedmusawir
 * License: 	GPL-2.0+ 
 *
 */

//If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die("Cannot Access Directly");
}


// require_once( plugin_dir_path( __FILE__ ) . 'class-moose-plugin-framework.php' );
require_once( plugin_dir_path( __FILE__ ) . '/inc/WPDox/class-wp-helpdesk-main.php' );
require_once( plugin_dir_path( __FILE__ ) . 'class-enqueue.php' );

function mpf_wp_helpdesk_start() {

	$setup_styles = new MPFWPHelpdeskEnqueue();
	$setup_styles->initialize();

	$wp_helpdesk = new MPFWPHelpdesk();

}

mpf_wp_helpdesk_start();

// Activation
require_once plugin_dir_path( __FILE__ ) . 'inc/Base/class-activate.php';
register_activation_hook( __FILE__, array( 'MPFWPHekpdeskActivate', 'activate' ) );

// Activation
require_once plugin_dir_path( __FILE__ ) . 'inc/Base/class-deactivate.php';
register_deactivation_hook( __FILE__, array( 'MPFWPHekpdeskDeactivate', 'deactivate' ) );
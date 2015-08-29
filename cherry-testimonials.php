<?php

/*
Plugin Name: Cherry Testimonials
Plugin URI: http://www.redcherries.net/cherry-testimonials
Description: TODO
Version: 1.0.0
Author: Red Cherries
Author URI: http://www.redcherries.net/
License: GPLv2
*/

/*******************************************
* Plugin CONSTANT
********************************************/
define( 'RCTE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'RCTE_PLUGIN_URL' , plugin_dir_url( __FILE__ ) );
define( 'RCTE_TEXT_DOMAIN', 'cherry-testimonials' );
define( 'RCTE_SLUG',        'cherry-testimonials' );

define( 'RCTE_SETTINGS_KEY', 'RCTE_Gallery_Settings_');

/*******************************************
* Global Variables
* variables and costants that are used 
* in this plug in
********************************************/



/*******************************************
* Includes
********************************************/

if ( is_admin() ) {
	// include admin side
	include( 'include/installer.php' );
	include( 'include/register-posttype.php' );

} else {
	// include for client side
	include( 'include/display-shortcode.php');
	
}

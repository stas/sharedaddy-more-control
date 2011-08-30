<?php
/*
Plugin Name: Sharedaddy More Control
Plugin URI: http://wordpress.org/extend/plugins/sharedaddy-more-control/
Description: Adds more options to control where Sharedaddy is being displayed
Author: Stas Sușcov
Version: 0.3
Author URI: http://stas.nerd.ro/
*/

define( 'SHAREDADDY_MC_ROOT', dirname( __FILE__ ) );
define( 'SHAREDADDY_MC_WEB_ROOT', WP_PLUGIN_URL . '/' . basename( SHAREDADDY_MC_ROOT ) );

require_once SHAREDADDY_MC_ROOT . '/includes/sharedaddy_mc.class.php';

/**
 * i18n
 */
function sharedaddy_mc_textdomain() {
    load_plugin_textdomain( 'sharedaddy-mc', false, basename( SHAREDADDY_MC_ROOT ) . '/languages' );
}
add_action( 'init', 'sharedaddy_mc_textdomain' );

SharedaddyMoreControl::init();

?>

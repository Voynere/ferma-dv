<?php
/**
 *Plugin Name: SMS.ru for Wordpress & WooCommerce
 *Description: SMS уведомлений с использованием шлюза SMS.RU
 *Version: 1.9
 *Author: Anton Shelestov
 *Author URI: http://verstaemvse.ru
 *Plugin URI: http://gosend.sms.ru
 */


if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

define( 'SMSRU_VERSION', '1.9' );
define( 'SMSRU_PREFIX_SLUG', 'smsru' );
define( 'SMSRU_DIR_PATH', dirname( __FILE__ ) );
define( 'SMSRU_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'SMSRU_INCLUDES_PATH', SMSRU_DIR_PATH . '/inc/' );
define( 'SMSRU_TEMPLATES_PATH', SMSRU_DIR_PATH . 'templates' );
define( 'SMSRU_BASENAME', plugin_basename( __FILE__ ) );

/*** Load Plugin Admin Option */
require_once( SMSRU_DIR_PATH . '/admin/classes/class-smsru-admin.php' );
require_once( SMSRU_DIR_PATH . '/admin/classes/class-smsru-start.php' );

if (in_array('woocommerce/woocommerce.php',apply_filters('active_plugins',get_option('active_plugins')))) {
    require_once( SMSRU_DIR_PATH . '/admin/classes/class-smsru-start-wc.php' );
}

require_once dirname( __FILE__ ) . '/includes/smsru-init.php';

add_action( 'plugins_loaded', array( 'Sms_Ru_Init', 'instance' ) );
register_activation_hook( __FILE__, array( 'Sms_Ru_Init', 'smsru_activate_plugin' ) );
register_deactivation_hook( __FILE__, array( 'Sms_Ru_Init', 'smsru_uninstall_plugin' ) );
<?php

class Sms_Ru_Admin_Menus {

	public $tabs = array();
	public static $message = '';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
	}

	public function admin_menu_page() {
		$plugin_hook_suffix = add_menu_page(
			'SMS оповещения',
			'SMS оповещения',
			'manage_options',
			'page-smsru',
			array( $this, 'generate_admin_page' ),
			'dashicons-location-alt',
			50
		);
	}

	/**
	 * Init the settings page.
	 */
	public function generate_admin_page() {
		$this->get_settings_page();
		$this->save_settings();
		$this->tabs = apply_filters( 'smsru_settings_tabs_array', $this->tabs );
		require_once( SMSRU_DIR_PATH . '/admin/views/admin.php' );
	}

	/**
	 * Save the settings page.
	 */
	public function save_settings() {
		$current_tab = ( isset( $_GET['tab'] ) ) ? sanitize_title( $_GET['tab'] ) : 'general';
		do_action( 'smsru_save_' . $current_tab );

	}

	public function get_settings_page() {
		$settings[] = require_once( SMSRU_DIR_PATH . '/admin/classes/class-smsru-admin-general-settings.php' );
		$settings[] = require_once( SMSRU_DIR_PATH . '/admin/classes/class-smsru-admin-site-event-settings.php' );
		$settings[] = require_once( SMSRU_DIR_PATH . '/admin/classes/class-smsru-admin-wc-event-settings.php' );
	}


	public static function get_message() {
		return self::$message;
	}

	public static function set_message( $class, $message ) {
		self::$message = '<div class=' . $class . '><p>' . $message . '</p></div>';
	}

	public function load_scripts( $hook ) {

	}
}

new Sms_Ru_Admin_Menus();
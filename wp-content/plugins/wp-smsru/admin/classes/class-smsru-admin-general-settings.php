<?php

if( !class_exists('SMSRU') ) {
    require_once( SMSRU_DIR_PATH . '/admin/classes/sms.ru.php' );
}

class Sms_Ru_Admin_General_Settings {
	public $id;
	public $label;
	public $settings;
    public $smsru;
    public $balance;
    public $senders;
    public $limit;

	public function __construct() {
		$this->id    = 'general';
		$this->label = "Основные настройки";
		add_filter( 'smsru_settings_tabs_array', array( $this, 'add_tabs' ) );
		add_action( 'smsru_settings_' . $this->id, array( $this, 'show_fields' ) );
		add_action( 'smsru_save_' . $this->id, array( $this, 'save_fields' ) );
	}

	public function add_tabs( $tabs ) {
		$tabs[ $this->id ] = $this->label;

		return $tabs;
	}

	public function show_fields() {
		$this->settings = get_option( 'smsru_settings' );

        if(isset($this->settings['api_id'])) {
            $this->smsru = new SMSRU( $this->settings['api_id'] );
        }

        if ($this->smsru) {
            $this->balance = $this->smsru->getBalance();
            $this->limit = $this->smsru->getLimit();
            $this->senders = $this->smsru->getSenders();
        }

		require_once( SMSRU_DIR_PATH . '/admin/views/settings.php' );
	}

	public function save_fields() {
		if ( ! isset( $_POST['smsru_settings_nonce'] ) || ! wp_verify_nonce( $_POST['smsru_settings_nonce'], 'verify_smsru_settings_nonce' ) ) {
			return false;
		}

		$config = array();
		if ( isset( $_POST['api_id'] ) && ! empty( $_POST['api_id'] ) ) {
			$config['api_id'] = sanitize_text_field($_POST['api_id']);
		}

		if ( isset( $_POST['test'] ) ) {
			$config['test'] = sanitize_text_field(intval($_POST['test']));
		}
		update_option( 'smsru_settings', $config );
		Sms_Ru_Admin_Menus::set_message( 'updated', 'Настройки сохранены.' );

	}
}

new Sms_Ru_Admin_General_Settings();
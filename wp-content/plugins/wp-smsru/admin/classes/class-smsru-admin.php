<?php

class Sms_Ru_Admin {
    public static $instance;

    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __construct() {
        /*load dependencies if required*/
        $this->load_dependencies();
    }

    public function load_dependencies() {
        include_once( dirname( __FILE__ ) . '/class-smsru-admin-menus.php' );
    }
}

/* Instantiate new class on plugins_loaded, best place to do this in MHO */
add_action( 'plugins_loaded', array( 'Sms_Ru_Admin', 'get_instance' ) );
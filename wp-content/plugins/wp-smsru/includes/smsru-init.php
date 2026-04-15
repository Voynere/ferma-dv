<?php


final class Sms_Ru_Init {

    public function __construct() {
        add_action( 'init', array( $this, 'smsru_register_scripts' ) );
        add_filter( 'plugin_action_links_' . SMSRU_BASENAME, array( $this, 'smsru_add_action_links' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'smsru_register_admin_scripts' ) );
    }

    protected static $instance;

    public static function instance() {
        if ( ! isset( self::$instance ) ) {
            $className      = __CLASS__;
            self::$instance = new $className;
        }

        return self::$instance;
    }

    /**
     * Run when plugin is activated
     *
     * @created by DarthVader
     * @modified R2-D2
     * @since  1.0.0
     */
    public static function smsru_activate_plugin() {

    }

    /**
     * Register scripts in front
     * @created by DarthVader
     * @modified R2-D2
     * @since  1.0.0
     */
    public function smsru_register_scripts() {
        wp_register_script( 'smsru-admin-js', SMSRU_DIR_URL . 'assets/admin/js/admin-script.js', array(
            'jquery',
        ), SMSRU_VERSION, true );
    }

    /**
     * Add Settings link in the plugins page
     * @created by DarthVader
     * @modified R2-D2
     * @since  1.0.0
     */
    public function smsru_add_action_links( $links ) {
        $mylinks = array(
            '<a href="http://yasobe.ru/na/wpsmsru" target="_blank">Сказать спасибо</a>',
        );

        return array_merge( $links, $mylinks );
    }

    /**
     * Unistalling the plugin
     * @created by DarthVader
     * @modified R2-D2
     * @since  1.0.0
     */
    public static function smsru_uninstall_plugin() {

    }

    /**
     * Registering and enqueing admin scripts
     * @author anakin
     * @since 1.0.0
     */
    public static function smsru_register_admin_scripts( $hook ) {

        // Load only on ?page=mypluginname
        if ( $hook != 'toplevel_page_page-smsru' ) {
            return;
        }
        wp_enqueue_script( 'smsru-admin-js' );
    }
}
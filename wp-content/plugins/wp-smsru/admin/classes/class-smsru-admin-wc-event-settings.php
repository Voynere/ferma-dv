<?php

if (!class_exists('SMSRU')) {
    require_once(SMSRU_DIR_PATH . '/admin/classes/sms.ru.php');
}

class Sms_Ru_Admin_Wc_Event_Settings
{
    public $id;
    public $label;
    public $settings;
    public $action_fields;
    public $smsru_settings;
    public $smsru;
    public $senders;

    public function __construct()
    {
        $this->id = 'wc_event';
        $this->label = "События WooCommerce";
        add_filter('smsru_settings_tabs_array', array($this, 'add_tabs'));
        add_action('smsru_settings_' . $this->id, array($this, 'show_fields'));
        add_action('smsru_save_' . $this->id, array($this, 'save_fields'));
    }

    public function add_tabs($tabs)
    {
        $tabs[$this->id] = $this->label;

        return $tabs;
    }

    public function show_fields()
    {

        if (!in_array('woocommerce/woocommerce.php',apply_filters('active_plugins',get_option('active_plugins')))) {
            require_once(SMSRU_DIR_PATH . '/admin/views/woocommerce_not_active.php');
            return;
        }

        $this->settings = get_option('smsru_wc_event_settings');
        $this->smsru_settings = get_option('smsru_settings');

        if (isset($this->smsru_settings['api_id'])) {
            $this->smsru = new SMSRU($this->smsru_settings['api_id']);
        }

        if ($this->smsru) {
            $this->senders = $this->smsru->getSenders();
        }

        $this->action_fields = $this->action_fields();

        require_once(SMSRU_DIR_PATH . '/admin/views/wc_event_settings.php');
    }

    public function save_fields()
    {
        if (!isset($_POST['smsru_settings_nonce']) || !wp_verify_nonce($_POST['smsru_settings_nonce'], 'verify_smsru_settings_nonce')) {
            return false;
        }

        $config = array();
        if (isset($_POST['phone']) && !empty($_POST['phone'])) {
            $config['phone'] = sanitize_text_field($_POST['phone']);
        }
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $config['name'] = sanitize_text_field($_POST['name']);
        }
        if (isset($_POST['time'])) {
            $config['time'] = sanitize_text_field(intval($_POST['time']));
        }
        if (isset($_POST['lat'])) {
            $config['lat'] = sanitize_text_field(intval($_POST['lat']));
        }

        if (isset($_POST['wc_event_admin'])) {
            $config['wc_event_admin'] = $_POST['wc_event_admin'];
        }

        if (isset($_POST['wc_event_client'])) {
            $config['wc_event_client'] = $_POST['wc_event_client'];
        }

        if (isset($_POST['custom_wc_event'])) {
            $config['custom_wc_event'] = $_POST['custom_wc_event'];
        }

        if (isset($_POST['custom_wc_status_event'])) {
            $config['custom_wc_status_event'] = $_POST['custom_wc_status_event'];
        }

        update_option('smsru_wc_event_settings', $config);
        Sms_Ru_Admin_Menus::set_message('updated', 'Настройки сохранены.');
    }

    public function action_fields()
    {
        return [
            'sections' => [
                'admin' => [
                    [
                        'title'  => 'Оповещение о новом заказе',
                        'action' => 'woocommerce_checkout_update_order_meta'
                    ],
                    [
                        'title'  => 'Оповещение о смене статуса заказа',
                        'action' => 'woocommerce_order_status_changed'
                    ],
                ],
                'client' => [
                    [
                        'title'  => 'Оповещение о новом заказе',
                        'action' => 'woocommerce_checkout_update_order_meta'
                    ],
                    [
                        'title'  => 'Оповещение о смене статуса заказа',
                        'action' => 'woocommerce_order_status_changed'
                    ],
                ],
            ],
            'fields'   => [
                [
                    'type'        => 'checkbox',
                    'title'       => 'Активировать оповещение',
                    'description' => '',
                    'name'        => 'active'
                ],
                [
                    'type'        => 'text',
                    'title'       => 'Телефон для оповещения',
                    'description' => 'Если указан, то телефон из общей настройки игнорируется.',
                    'name'        => 'phone',
                    'attr'        => [
                        'class' => 'regular-text'
                    ]
                ],
                [
                    'type'        => 'number',
                    'title'       => 'Задержка перед отправкой сообщения',
                    'description' => 'Если указана, то задержка из общей настройки игнорируется.',
                    'name'        => 'time',
                    'attr'        => [
                        'min'   => 0,
                        'step'  => 1,
                        'class' => 'regular-text'
                    ]
                ],
                [
                    'type'        => 'textarea',
                    'title'       => 'Шаблон сообщения',
                    'description' => '',
                    'name'        => 'message',
                    'attr'        => [
                        'rows'  => 3,
                        'class' => 'large-text code'
                    ]
                ]
            ],
        ];
    }

}

new Sms_Ru_Admin_Wc_Event_Settings();
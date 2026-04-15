<?php

if (!class_exists('SMSRU')) {
    require_once(SMSRU_DIR_PATH . '/admin/classes/sms.ru.php');
}

class Sms_Ru_Start_Wc
{
    protected $general_settings;
    protected $wc_settings;
    protected $smsru;
    protected $data;
    protected $current_admin_event;
    protected $current_client_event;
    protected $custom_wc_event_variable;
    protected $custom_wc_status_event_variable;

    public static $instance;

    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Sms_Ru_Start constructor.
     */
    public function __construct()
    {
        $this->general_settings = get_option('smsru_settings');
        $this->wc_settings = get_option('smsru_wc_event_settings');
		
        if (isset($this->general_settings['api_id'])) {
            $this->smsru = new SMSRU($this->general_settings['api_id']);
        }

        if ($this->smsru) {
            $this->set_options();

            $this->set_wc_event();

            $this->set_custom_wc_event();

            $this->set_status_wc_event();
        }
    }

    public function set_options()
    {
        $this->data = new stdClass();

        if (isset($this->general_settings['test'])) {
            $this->data->test = $this->general_settings['test'];
        }

        $this->data->partner_id = '18463';
    }

    public function set_wc_options()
    {
        if (isset($this->wc_settings['name'])) {
            $this->data->from = $this->wc_settings['name'];
        }

        if (isset($this->wc_settings['phone'])) {
            $this->data->to = $this->wc_settings['phone'];
        }

        if (isset($this->wc_settings['time'])) {
            if ((int)$this->wc_settings['time'] > 0) {
                $this->data->time = time() + $this->wc_settings['time'];
            }
        }

        if (isset($this->wc_settings['lat'])) {
            $this->data->translit = $this->wc_settings['lat'];
        }

    }

    public function set_single_options($event, $func, $type)
    {
        $data = new stdClass();

        if (isset($event['phone']) && !empty($event['phone'])) {
            $data->to = $event['phone'];
        }

        if (isset($event['time'])) {
            if ((int)$event['time'] > 0) {
                $data->time = time() + $event['time'];
            }
        }
        if (isset($event['message'])) {
            $data->text = $event['message'];
        }
		
		$result_data = (object)array_merge((array)$this->data, (array)$data);
		
		switch($type) {
			case 'current_admin_event';
				$this->current_admin_event[$func] = $result_data;
				break;
			case 'custom_wc_event_variable';
				$this->custom_wc_event_variable[$func] = $result_data;
				break;
			case 'custom_wc_status_event_variable';
				$this->custom_wc_status_event_variable[$func] = $result_data;
				break;
			case 'current_client_event';
				$this->current_client_event[$func] = $result_data;
				break;
		}
        //$this->current_admin_event[$func] = (object)array_merge((array)$this->data, (array)$data);
		
        //wp_mail('shelestov.a.s@gmail.com', 'проверка', print_r(array($event, $func, $type, (object)array_merge((array)$this->data, (array)$data), $this->current_admin_event), true));

    }


    public function set_custom_wc_event()
    {
        $this->set_wc_options();

        if (isset($this->wc_settings['custom_wc_event'])) {
            foreach ($this->wc_settings['custom_wc_event'] as $key => $event) {
                if (isset($event['active']) && $event['active'] == 1 && isset($event['message']) && !empty($event['message'])) {

                    $this->set_single_options($event, $event['action'] . '_' . $key, 'custom_wc_event_variable');
                    add_action($event['action'], function () use ($event, $key) {
                        $this->smsru->send($this->custom_wc_event_variable[$event['action'] . '_' . $key]);
                    });
                }
            }
        }
    }

    public function set_status_wc_event()
    {
        $this->set_wc_options();

        if (isset($this->wc_settings['custom_wc_status_event'])) {
            foreach ($this->wc_settings['custom_wc_status_event'] as $key => $event) {
                if (isset($event['active']) && $event['active'] == 1 && isset($event['message']) && !empty($event['message'])) {


                    $this->set_single_options($event, $event['status'] . '_' . $key, 'custom_wc_status_event_variable');
                    add_action('woocommerce_order_status_' . str_replace('wc-', '', $event['status']), function ($order_id) use ($event, $key) {

                        $order = new WC_Order($order_id);
                        $search = array('{NUM}', '{SUM}', '{EMAIL}', '{PHONE}', '{FIRSTNAME}', '{LASTNAME}', '{CITY}', '{ADDRESS}', '{BLOGNAME}', '{NEW_STATUS}');
                        $replace = [
                            $order->get_order_number(),
                            $order->get_total(),
                            $order->billing_email,
                            $order->billing_phone,
                            $order->billing_first_name,
                            $order->billing_last_name,
                            $order->billing_city,
                            $order->billing_state . ' ' . $order->billing_address_1 . ' ' . $order->billing_address_2,
                            get_option('blogname'),
                            wc_get_order_status_name($order->get_status()),
                        ];

                        if(isset($event['phone']) && !empty($event['phone'])) {
                            $this->custom_wc_status_event_variable[$event['status'] . '_' . $key]->to = str_replace('{PHONE}', $order->billing_phone, $this->custom_wc_status_event_variable[$event['status'] . '_' . $key]->to);
                        }
                        $this->custom_wc_status_event_variable[$event['status'] . '_' . $key]->text = str_replace($search, $replace, $this->custom_wc_status_event_variable[$event['status'] . '_' . $key]->text);
                        $this->smsru->send($this->custom_wc_status_event_variable[$event['status'] . '_' . $key]);

                        //wp_mail('shelestov.a.s@gmail.com', 'конкретный статус', print_r(array($order_id, $order->get_status(), $order, $this->custom_wc_status_event_variable[$event['status'] . '_' . $key]), true));
                    });
                }
            }
        }
    }

    public function set_wc_event()
    {
        $this->set_wc_options();

        $action_functions = [
            'woocommerce_checkout_update_order_meta' => ['admin_woocommerce_checkout_update_order_meta', 2],
            'woocommerce_order_status_changed'       => ['admin_woocommerce_order_status_changed', 3],
            //'upgrader_post_install|theme|update'   => ['site_upgrader_post_install_theme_update', 3],
        ];

        if (isset($this->wc_settings['wc_event_admin'])) {
			foreach ($this->wc_settings['wc_event_admin'] as $event) {
				if (isset($event['active']) && $event['active'] == 1 && isset($event['message']) && !empty($event['message'])) {

					$type = $event['action'];
					$this->set_single_options($event, $action_functions[$type][0], 'current_admin_event');
					add_action($event['action'], array($this, $action_functions[$type][0]), 10, $action_functions[$type][1]);

				}
			}
		}

        $action_functions_client = [
            'woocommerce_checkout_update_order_meta' => ['client_woocommerce_checkout_update_order_meta', 2],
            'woocommerce_order_status_changed'       => ['client_woocommerce_order_status_changed', 3],
            //'upgrader_post_install|theme|update'   => ['site_upgrader_post_install_theme_update', 3],
        ];

        if (isset($this->wc_settings['wc_event_client'])) {
			foreach ($this->wc_settings['wc_event_client'] as $event) {
				if (isset($event['active']) && $event['active'] == 1 && isset($event['message']) && !empty($event['message'])) {

					$type = $event['action'];
					$this->set_single_options($event, $action_functions_client[$type][0], 'current_client_event');
					add_action($event['action'], array($this, $action_functions_client[$type][0]), 10, $action_functions_client[$type][1]);

				}
			}
		}
    }


    //оповещение для клиента о смене статуса заказа
    public function client_woocommerce_order_status_changed($order_id, $old_status, $new_status)
    {
        $order = new WC_Order($order_id);
        $search = array('{NUM}', '{SUM}', '{EMAIL}', '{PHONE}', '{FIRSTNAME}', '{LASTNAME}', '{CITY}', '{ADDRESS}', '{BLOGNAME}', '{OLD_STATUS}', '{NEW_STATUS}');
        $replace = [
            $order->get_order_number(),
            $order->get_total(),
            $order->billing_email,
            $order->billing_phone,
            $order->billing_first_name,
            $order->billing_last_name,
            $order->billing_city,
            $order->billing_state . ' ' . $order->billing_address_1 . ' ' . $order->billing_address_2,
            get_option('blogname'),
            wc_get_order_status_name($old_status),
            wc_get_order_status_name($new_status)
        ];
        $this->current_client_event[__FUNCTION__]->to = $order->billing_phone;
        $this->current_client_event[__FUNCTION__]->text = str_replace($search, $replace, $this->current_client_event[__FUNCTION__]->text);
        $this->smsru->send($this->current_client_event[__FUNCTION__]);
        //wp_mail('shelestov.a.s@gmail.com', 'смена статуса', print_r(array($order, $order_id, $old_status, $new_status, $this->current_admin_event[__FUNCTION__]), true));
    }

    // для клиента если оформлен новый заказ
    public function client_woocommerce_checkout_update_order_meta($order_id, $data)
    {
        $search = array('{NUM}', '{SUM}', '{EMAIL}', '{PHONE}', '{FIRSTNAME}', '{LASTNAME}', '{CITY}', '{ADDRESS}', '{BLOGNAME}');

        $order = wc_get_order($order_id);

        $replace = [
            $order->get_order_number(),
            $order->get_total(),
            $order->billing_email,
            $order->billing_phone,
            $order->billing_first_name,
            $order->billing_last_name,
            $order->billing_city,
            $order->billing_state . ' ' . $order->billing_address_1 . ' ' . $order->billing_address_2,
            get_option('blogname'),
        ];
        $this->current_client_event[__FUNCTION__]->to = $order->billing_phone;
        $this->current_client_event[__FUNCTION__]->text = str_replace($search, $replace, $this->current_client_event[__FUNCTION__]->text);

        $this->smsru->send($this->current_client_event[__FUNCTION__]);
        //wp_mail('shelestov.a.s@gmail.com', 'новый заказ', print_r(array($order, $data, $this->current_client_event[__FUNCTION__]), true));

    }

    // для админа если оформлен новый заказ
    public function admin_woocommerce_checkout_update_order_meta($order_id, $data)
    {		
        $search = array('{NUM}', '{SUM}', '{EMAIL}', '{PHONE}', '{FIRSTNAME}', '{LASTNAME}', '{CITY}', '{ADDRESS}', '{BLOGNAME}');

        $order = wc_get_order($order_id);

        $replace = [
            $order->get_order_number(),
            $order->get_total(),
            $order->billing_email,
            $order->billing_phone,
            $order->billing_first_name,
            $order->billing_last_name,
            $order->billing_city,
            $order->billing_state . ' ' . $order->billing_address_1 . ' ' . $order->billing_address_2,
            get_option('blogname'),
        ];
        $this->current_admin_event[__FUNCTION__]->text = str_replace($search, $replace, $this->current_admin_event[__FUNCTION__]->text);

        $this->smsru->send($this->current_admin_event[__FUNCTION__]);
		
        /*wp_mail('shelestov.a.s@gmail.com', 'новый заказ', print_r(array(
			$this->wc_settings['wc_event_admin'], 
			$this->current_admin_event, 
			$this->current_admin_event[__FUNCTION__], 
			$this->data
		), true));*/

    }

    //оповещение для админа о смене статуса заказа
    public function admin_woocommerce_order_status_changed($order_id, $old_status, $new_status)
    {
        $order = new WC_Order($order_id);
        $search = array('{NUM}', '{SUM}', '{EMAIL}', '{PHONE}', '{FIRSTNAME}', '{LASTNAME}', '{CITY}', '{ADDRESS}', '{BLOGNAME}', '{OLD_STATUS}', '{NEW_STATUS}');
        $replace = [
            $order->get_order_number(),
            $order->get_total(),
            $order->billing_email,
            $order->billing_phone,
            $order->billing_first_name,
            $order->billing_last_name,
            $order->billing_city,
            $order->billing_state . ' ' . $order->billing_address_1 . ' ' . $order->billing_address_2,
            get_option('blogname'),
            wc_get_order_status_name($old_status),
            wc_get_order_status_name($new_status)
        ];
        $this->current_admin_event[__FUNCTION__]->text = str_replace($search, $replace, $this->current_admin_event[__FUNCTION__]->text);
        $this->smsru->send($this->current_admin_event[__FUNCTION__]);
        //wp_mail('shelestov.a.s@gmail.com', 'смена статуса', print_r(array($order, $order_id, $old_status, $new_status, $this->current_admin_event[__FUNCTION__]), true));
    }

}

//new Sms_Ru_Start();
add_action('plugins_loaded', array('Sms_Ru_Start_Wc', 'get_instance'));
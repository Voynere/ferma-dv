<?php

if (!class_exists('SMSRU')) {
    require_once(SMSRU_DIR_PATH . '/admin/classes/sms.ru.php');
}

class Sms_Ru_Start
{
    protected $general_settings;
    protected $site_settings;
    protected $wc_settings;
    protected $smsru;
    protected $data;
    protected $current_event;

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
        $this->site_settings = get_option('smsru_site_event_settings');
        $this->wc_settings = get_option('smsru_wc_event_settings');

        if (isset($this->general_settings['api_id'])) {
            $this->smsru = new SMSRU($this->general_settings['api_id']);
        }

        if ($this->smsru) {
            $this->set_options();

            $this->set_site_event();

            $this->set_custom_site_event();
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

    public function set_site_options()
    {
        if (isset($this->site_settings['name'])) {
            $this->data->from = $this->site_settings['name'];
        }

        if (isset($this->site_settings['phone'])) {
            $this->data->to = $this->site_settings['phone'];
        }

        if (isset($this->site_settings['time'])) {
            if ((int)$this->site_settings['time'] > 0) {
                $this->data->time = time() + $this->site_settings['time'];
            }
        }

        if (isset($this->site_settings['lat'])) {
            $this->data->translit = $this->site_settings['lat'];
        }

    }

    public function set_single_options($event, $func)
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

        $this->current_event[$func] = (object)array_merge((array)$this->data, (array)$data);

    }

    public function set_custom_site_event()
    {
        $this->set_site_options();

        if (isset($this->site_settings['custom_site_event'])) {
            foreach ($this->site_settings['custom_site_event'] as $key => $event) {
                if (isset($event['active']) && $event['active'] == 1 && isset($event['message']) && !empty($event['message'])) {

                    $this->set_single_options($event, $event['action'] . '_' . $key);
                    add_action($event['action'], function () use ($event, $key) {
                        $this->smsru->send($this->current_event[$event['action'] . '_' . $key]);
                    });
                }
            }
        }
    }

    public function set_site_event()
    {
        $this->set_site_options();

        $action_functions = [
            'publish_post'                         => ['site_publish_post', 1],
            'post_updated'                         => ['site_post_updated', 3],
            'wp_login'                             => ['site_wp_login', 2],
            'upgrader_post_install|plugin|install' => ['site_upgrader_post_install_plugin', 3],
            'upgrader_post_install|plugin|update'  => ['site_upgrader_post_install_plugin_update', 3],
            'upgrader_post_install|theme|install'  => ['site_upgrader_post_install_theme', 3],
            'upgrader_post_install|theme|update'   => ['site_upgrader_post_install_theme_update', 3],
        ];

		if(isset($this->site_settings['site_event'])) {
			foreach ($this->site_settings['site_event'] as $event) {
				if (isset($event['active']) && $event['active'] == 1 && isset($event['message']) && !empty($event['message'])) {

					if (isset($event['type'])) {
						$type = $event['action'] . '|' . $event['type'];
					} else {
						$type = $event['action'];
					}
					$this->set_single_options($event, $action_functions[$type][0]);
					add_action($event['action'], array($this, $action_functions[$type][0]), 10, $action_functions[$type][1]);

				}
			}
		}
    }

    // произвольное событие
    function smsru_custom_event()
    {

    }

    // если была обновлена тема
    public function site_upgrader_post_install_theme_update($a, $b, $c)
    {
        if (isset($b['theme'])) {
            $search = array('{THEME}', '{TIME}');
            $replace = array($c['destination_name'], date("m.d.Y в H:i:s"));

            $this->current_event[__FUNCTION__]->text = str_replace($search, $replace, $this->current_event[__FUNCTION__]->text);

            $this->smsru->send($this->current_event[__FUNCTION__]);
            //wp_mail('shelestov.a.s@gmail.com', 'Обновление темы', print_r(array($a, $b, $c, $msg, __FUNCTION__), true));
        }
    }

    // если была установлена тема
    public function site_upgrader_post_install_theme($a, $b, $c)
    {
        if ($b['type'] == 'theme' && $b['action'] == 'install') {
            $search = array('{THEME}', '{TIME}');
            $replace = array($c['destination_name'], date("m.d.Y в H:i:s"));

            $this->current_event[__FUNCTION__]->text = str_replace($search, $replace, $this->current_event[__FUNCTION__]->text);

            $this->smsru->send($this->current_event[__FUNCTION__]);
            //wp_mail('shelestov.a.s@gmail.com', 'Установка темы', print_r(array($a, $b, $c, $msg, __FUNCTION__), true));
        }
    }

    // если был обновлен плагин
    public function site_upgrader_post_install_plugin_update($a, $b, $c)
    {
        if (isset($b['plugin'])) {
            $search = array('{PLUGIN}', '{TIME}');
            $replace = array($c['destination_name'], date("m.d.Y в H:i:s"));

            $this->current_event[__FUNCTION__]->text = str_replace($search, $replace, $this->current_event[__FUNCTION__]->text);

            $this->smsru->send($this->current_event[__FUNCTION__]);
            //wp_mail('shelestov.a.s@gmail.com', 'Обновление плагина', print_r(array($a, $b, $c, $msg, __FUNCTION__), true));
        }
    }

    // если был установлен плагин
    public function site_upgrader_post_install_plugin($a, $b, $c)
    {
        if ($b['type'] == 'plugin' && $b['action'] == 'install') {
            $search = array('{PLUGIN}', '{TIME}');
            $replace = array($c['destination_name'], date("m.d.Y в H:i:s"));

            $this->current_event[__FUNCTION__]->text = str_replace($search, $replace, $this->current_event[__FUNCTION__]->text);

            $this->smsru->send($this->current_event[__FUNCTION__]);
            //wp_mail('shelestov.a.s@gmail.com', 'Установка плагина', print_r(array($a, $b, $c, $msg, __FUNCTION__, $this->current_event), true));
        }
    }

    // если залогинился пользователь
    public function site_wp_login($user_login, $user)
    {
        $search = array('{USER}', '{TIME}');
        $replace = array($user_login, date("m.d.Y в H:i:s"));

        $this->current_event[__FUNCTION__]->text = str_replace($search, $replace, $this->current_event[__FUNCTION__]->text);

        $this->smsru->send($this->current_event[__FUNCTION__]);
        //wp_mail('shelestov.a.s@gmail.com', 'Пользователь залогинился', print_r(array($user_login, $user, $this->current_event, $msg, __FUNCTION__), true));
    }

    // обновление поста
    public function site_post_updated($post_ID, $post_after, $post_before)
    {

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        } else if ($post_before->post_status == 'auto-draft') {
            return;
        } else {
            $authname = get_user_by('id', $post_after->post_author);

            $search = array('{USER}', '{POSTID}', '{POSTTITLE}');
            $replace = array($authname->user_login, $post_ID, $post_after->post_title);

            $this->current_event[__FUNCTION__]->text = str_replace($search, $replace, $this->current_event[__FUNCTION__]->text);

            $this->smsru->send($this->current_event[__FUNCTION__]);
            //wp_mail('shelestov.a.s@gmail.com', 'ОБНОВЛЕНИЕ ПОСТА', print_r(array($post_ID, $post_after, $post_before, $this->current_event, $msg, __FUNCTION__), true));
        }

    }

    // создание поста
    public function site_publish_post($post_id)
    {
        $post = get_post($post_id);
        $authname = get_user_by('id', $post->post_author);

        $search = array('{USER}', '{POSTID}', '{POSTTITLE}');
        $replace = array($authname->user_login, $post->ID, $post->post_title);

        $this->current_event[__FUNCTION__]->text = str_replace($search, $replace, $this->current_event[__FUNCTION__]->text);

        $this->smsru->send($this->current_event[__FUNCTION__]);
    }
}

//new Sms_Ru_Start();
add_action('plugins_loaded', array('Sms_Ru_Start', 'get_instance'));
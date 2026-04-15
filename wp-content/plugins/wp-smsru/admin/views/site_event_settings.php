<?php
//Load Data
$api_id = '';
if (isset($this->smsru_settings['api_id']) && !empty($this->smsru_settings['api_id'])) {
    $api_id = $this->smsru_settings['api_id'];
}

$phone = '';
if (isset($this->settings['phone']) && !empty($this->settings['phone'])) {
    $phone = $this->settings['phone'];
}

$name = '';
if (isset($this->settings['name']) && !empty($this->settings['name'])) {
    $name = $this->settings['name'];
}

$time = 0;
if (isset($this->settings['time']) && !empty($this->settings['time'])) {
    $time = $this->settings['time'];
}

$lat = 0;
if (isset($this->settings['lat'])) {
    $lat = $this->settings['lat'];
}

$site_event = [];
if (isset($this->settings['site_event'])) {
    $site_event = $this->settings['site_event'];
}

$custom_site_event = [];
if (isset($this->settings['custom_site_event'])) {
    $custom_site_event = $this->settings['custom_site_event'];
}

?>

<form id="smsru-site-event-settings-form" class="" action="" method="post" data-smsru-validate="true">
    <?php wp_nonce_field('verify_smsru_settings_nonce', 'smsru_settings_nonce'); ?>
    <h2>Настройки СМС оповещений о событиях на сайте</h2>
    <table class="form-table">
        <tr>
            <th><label for="api_id">Телефон для оповещения о событиях на сайте</label></th>
            <td>
                <input type="text" id="phone" name="phone" class="regular-text"
                       value="<?php echo esc_attr($phone); ?>"/>
                <p class="description">
                    Телефоны можно указывать через запятую без пробелов.
                </p>
            </td>
        </tr>
        <tr>
            <th><label for="name">Имя отправителя</label></th>
            <td>
                <?php if ($api_id == '') : ?>
                    Сначала укажите api_id и сохрание настройки.
                <?php else : ?>
                    <?php if ($this->senders->status == "OK") : ?>
                        <select id="name" name="name">
                            <option value="">---</option>
                            <?php foreach ($this->senders->senders as $key => $sender) : ?>
                                <option value="<?php echo $sender ?>" <?php echo($sender == $name ? 'selected' : '') ?>><?php echo $sender ?></option>';
                            <?php endforeach; ?>
                        </select>
                        <p class="description">При пустом значении, в имя отправителя подставляется Ваш номер.</p>
                    <?php else : ?>
                        Несуществующий api_id.
                    <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><label for="time">Задержка перед отправкой сообщения</label></th>
            <td>
                <input type="number" id="time" name="time" class="regular-text" value="<?php echo esc_attr($time); ?>"/>
                <p class="description">
                    Откладывает отправку сообщения на указанное время.<br/>
                    Время, на которое нужно отложить отправку указывается в секундах!!! Пример 252000 = 7 часов
                </p>
            </td>
        </tr>
        <tr>
            <th><label for="lat">Перевод всех русских символов в латинские</label></th>
            <td>
                <input type="checkbox" id="lat" name="lat" value="1" <?php echo($lat == 1 ? 'checked' : '') ?> />
            </td>
        </tr>
    </table>

    <hr>

    <p>Для каждого вида оповещения можно задать свой шаблон сообщения. Варианты макросов:</p>
    <ul>
        <li>{USER} - автор страницы/записи</li>
        <li>{POSTID} - ID номер страницы/записи</li>
        <li>{POSTTITLE} - название страницы/записи</li>
        <li>{PLUGIN} - название плагина</li>
        <li>{TIME} - время выполненного действия</li>
        <li>{THEME} - название темы</li>
    </ul>

    <hr>

    <h2>Варианты оповещений</h2>

    <?php foreach ($this->action_fields['sections'] as $key => $fields) : ?>
        <div class="welcome-panel" style="padding: 15px">
            <h3 style="margin: 0;"><?= $fields['title'] ?></h3>
            <input type="hidden" name="site_event[<?= $key ?>][action]" value="<?= $fields['action'] ?>">
            <?php if (isset($fields['type'])) : ?>
                <input type="hidden" name="site_event[<?= $key ?>][type]" value="<?= $fields['type'] ?>">
            <?php endif; ?>
            <table class="form-table">
                <?php foreach ($this->action_fields['fields'] as $index => $field) : ?>
                    <tr>
                        <?php
                        $field_id = 'site_' . $fields['action'] . '_' . $field['name'] . '_' . wp_rand(99, 99999);
                        ?>
                        <th><label for="<?= $field_id ?>"><?= $field['title'] ?></label></th>
                        <td>
                            <?php
                            $field_name = 'site_event[' . $key . '][' . $field['name'] . ']';

                            $field_attr = [];
                            if (isset($field['attr'])) {
                                foreach ($field['attr'] as $attr => $value) {
                                    $field_attr[] = $attr . '="' . $value . '"';
                                }
                            }
                            $field_attr = implode(' ', $field_attr);

                            $field_value = isset($site_event[$key][$field['name']]) ? $site_event[$key][$field['name']] : '';

                            switch ($field['type']) {
                                case 'checkbox':
                                    echo '<input type="checkbox" id="' . $field_id . '" name="' . $field_name . '" ' . $field_attr . ' value="1" ' . (isset($site_event[$key][$field['name']]) ? 'checked' : '') . ' />';
                                    break;

                                case 'text':
                                    echo '<input type="text" id="' . $field_id . '" name="' . $field_name . '" ' . $field_attr . ' value="' . $field_value . '" />';
                                    break;

                                case 'number':
                                    echo '<input type="number" id="' . $field_id . '" name="' . $field_name . '" ' . $field_attr . ' value="' . $field_value . '" />';
                                    break;

                                case 'textarea':
                                    echo '<textarea id="' . $field_id . '" name="' . $field_name . '" ' . $field_attr . '>' . $field_value . '</textarea>';
                                    if (isset($fields['textarea_description']) && !empty($fields['textarea_description'])) {
                                        echo '<p class="description">' . $fields['textarea_description'] . '</p>';
                                    }
                                    break;
                            }
                            ?>
                            <?php if (isset($field['description']) && !empty($field['description'])) : ?>
                                <p class="description"><?= $field['description'] ?></p>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endforeach; ?>

    <hr>

    <h2 style="margin-top: 30px">Пользовательские события для оповещений</h2>

    <div id="custom_site_event">
        <?php foreach ($custom_site_event as $key => $field) : ?>
            <div class="welcome-panel" style="padding: 15px" data-num="<?= $key ?>">
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th><label for="custom_site_event_action_<?= $key ?>">Фильтер или Событие(filter,
                                action)</label></th>
                        <td>
                            <input type="text" id="custom_site_event_action_<?= $key ?>" class="regular-text"
                                   name="custom_site_event[<?= $key ?>][action]" value="<?= $field['action'] ?>">
                            <p class="description">Укажите фильтер или событие при отработке которого будет отправляться
                                сообщение.</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="custom_site_event_active_<?= $key ?>">Активировать оповещение</label></th>
                        <td>
                            <input type="checkbox" id="custom_site_event_active_<?= $key ?>"
                                   name="custom_site_event[<?= $key ?>][active]"
                                   value="1" <?= (isset($field['active']) ? 'checked' : '') ?>>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="custom_site_event_phone_<?= $key ?>">Телефон для оповещения</label></th>
                        <td>
                            <input type="text" id="custom_site_event_phone_<?= $key ?>"
                                   name="custom_site_event[<?= $key ?>][phone]" class="regular-text"
                                   value="<?= $field['phone'] ?>">
                            <p class="description">Если указан, то телефон из общей настройки игнорируется.</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="custom_site_event_time_<?= $key ?>">Задержка перед отправкой сообщения</label>
                        </th>
                        <td>
                            <input type="number" id="custom_site_event_time_<?= $key ?>"
                                   name="custom_site_event[<?= $key ?>][time]" min="0" step="1" class="regular-text"
                                   value="<?= $field['time'] ?>">
                            <p class="description">Если указана, то задержка из общей настройки игнорируется.</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="custom_site_event_message_<?= $key ?>">Шаблон сообщения</label></th>
                        <td>
                            <textarea id="custom_site_event_message_<?= $key ?>"
                                      name="custom_site_event[<?= $key ?>][message]" rows="3"
                                      class="large-text code"><?= $field['message'] ?></textarea>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button class="button button-secondary remove_custom_site_event" type="button" style="float:right">
                    Yдалить
                </button>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="button button-secondary" id="add_custom_site_event" type="button">Добавить</button>

    <p class="submit">
        <input type="submit" class="button button-primary" value="Сохранить"/>
    </p>
</form>
<div id="custom_site_event_template" style="display:none;">
    <div class="welcome-panel" style="padding: 15px" data-num="%%num%%">
        <table class="form-table">
            <tbody>
            <tr>
                <th><label for="custom_site_event_action_%%num%%">Фильтер или Событие(filter, action)</label></th>
                <td>
                    <input type="text" id="custom_site_event_action_%%num%%" class="regular-text"
                           %%name%%="custom_site_event[%%num%%][action]" value="">
                    <p class="description">Укажите фильтер или событие при отработке которого будет отправляться
                        сообщение.</p>
                </td>
            </tr>
            <tr>
                <th><label for="custom_site_event_active_%%num%%">Активировать оповещение</label></th>
                <td>
                    <input type="checkbox" id="custom_site_event_active_%%num%%"
                           %%name%%="custom_site_event[%%num%%][active]" value="1">
                </td>
            </tr>
            <tr>
                <th><label for="custom_site_event_phone_%%num%%">Телефон для оповещения</label></th>
                <td>
                    <input type="text" id="custom_site_event_phone_%%num%%" %%name%%="custom_site_event[%%num%%][phone]"
                           class="regular-text" value="">
                    <p class="description">Если указан, то телефон из общей настройки игнорируется.</p>
                </td>
            </tr>
            <tr>
                <th><label for="custom_site_event_time_%%num%%">Задержка перед отправкой сообщения</label></th>
                <td>
                    <input type="number" id="custom_site_event_time_%%num%%" %%name%%="custom_site_event[%%num%%][time]"
                           min="0" step="1" class="regular-text" value="">
                    <p class="description">Если указана, то задержка из общей настройки игнорируется.</p>
                </td>
            </tr>
            <tr>
                <th><label for="custom_site_event_message_%%num%%">Шаблон сообщения</label></th>
                <td>
                    <textarea id="custom_site_event_message_%%num%%" %%name%%="custom_site_event[%%num%%][message]"
                              rows="3" class="large-text code"></textarea>
                </td>
            </tr>
            </tbody>
        </table>
        <button class="button button-secondary remove_custom_site_event" type="button" style="float:right">Yдалить
        </button>
    </div>
</div>

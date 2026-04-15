<?php
//Load Data
$api_id = '';
if ( isset( $this->settings['api_id'] ) && ! empty( $this->settings['api_id'] ) ) {
    $api_id = $this->settings['api_id'];
}
$test = 0;
if ( isset( $this->settings['test'] ) ) {
    $test = $this->settings['test'];
}
?>

<form id="smsru-general-settings-form" class="" action="" method="post" data-smsru-validate="true">
	<?php wp_nonce_field( 'verify_smsru_settings_nonce', 'smsru_settings_nonce' ); ?>
    <h2>Данные с сервиса SMS.ru(<a href="http://gosend.sms.ru" target="_blank">регистрация в SMS.ru скидка 10%</a>)</h2>
    <table class="form-table">
        <tr>
            <th><label for="api_id">Ваш api_id</label></th>
            <td>
                <input type="text" id="api_id" name="api_id" class="regular-text" value="<?php echo esc_attr($api_id); ?>"/>
            </td>
        </tr>
        <tr>
            <th><label for="test">Тестовый режим</label></th>
            <td>
                <input type="checkbox" id="test" name="test" value="1" <?php echo ($test == 1 ? 'checked' : '') ?> />
                <p class="description" id="tagline-description">Статус отправленного сообщения можно будет посмотреть в личном кабинете.</p>
            </td>
        </tr>
    </table>

    <h2>Ваш баланс</h2>
    <?php if($api_id == '') : ?>
        Сначала укажите api_id и сохрание настройки.
    <?php else : ?>
        <?php if ($this->balance->status == "OK") : ?>
            Ваш баланс: <?php echo $this->balance->balance ?> руб.
        <?php else : ?>
            Ошибка при выполнении запроса.<br />
            Код ошибки: <?php echo $this->balance->status_code ?>.<br />
            Текст ошибки: <?php echo $this->balance->status_text ?>.<br />
        <?php endif; ?>
    <?php endif; ?>

    <h2>Дневной лимит</h2>
    <?php if($api_id == '') : ?>
        Сначала укажите api_id и сохрание настройки.
    <?php else : ?>
        <?php if ($this->limit->status == "OK") : ?>
            Ваш лимит: <?php echo $this->limit->total_limit ?> <br />
            Использовано сегодня: <?php echo $this->limit->used_today ?> <br />
        <?php else : ?>
            Ошибка при выполнении запроса.<br />
            Код ошибки: <?php echo $this->limit->status_code ?>.<br />
            Текст ошибки: <?php echo $this->limit->status_text ?>.<br />
        <?php endif; ?>
        Для увеличения лимита перейдите по сылке: <a href="https://sms.ru/?panel=my&subpanel=limit" target="_blank">увеличить лимит</a>
    <?php endif; ?>

    <h2>Отправители</h2>
    <?php if($api_id == '') : ?>
        Сначала укажите api_id и сохрание настройки.
    <?php else : ?>
        <?php if ($this->senders->status == "OK") : ?>
            <?php foreach ($this->senders->senders as $key => $sender) : ?>
                Отправитель № <?php echo $key + 1 ?> - <?php echo $sender ?><br />
            <?php endforeach; ?>
        <?php else : ?>
            Ошибка при выполнении запроса.<br />
            Код ошибки: <?php echo $this->senders->status_code ?>.<br />
            Текст ошибки: <?php echo $this->senders->status_text ?>.<br />
        <?php endif; ?>
        Для редактирования отправителей перейдите по сылке: <a href="https://gosend.sms.ru/?panel=senders" target="_blank">редактировать отправителей</a>
    <?php endif; ?>

    <p class="submit">
        <input type="submit" class="button button-primary" value="Сохранить"/>
    </p>
</form>

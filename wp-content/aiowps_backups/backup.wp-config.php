<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/var/www/www-root/data/www/ferma-dv.ru/public_html/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'webmasjz_ferma' );
/** Имя пользователя MySQL */
define( 'DB_USER', 'webmasjz_ferma' );
/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 's1EN*wJU' );
/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );
/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );
/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );
define( 'DISABLE_WP_CRON', true );
define('WP_MEMORY_LIMIT', '256M');
/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Q2;6+y<Nb_Xw<qRVu}r|k-y?p32v/tr<oU%~yXGU~ag5? .rdpGe|K@W3)KDp&=d');
define('SECURE_AUTH_KEY',  'yE2=8oB}G/)]xN}!!,[ y )>dQQ+@ts-.Fx1R/G`a+-&N)`*J+>65m{7PGZO_{C$');
define('LOGGED_IN_KEY',    'wKTW5B^|ocOBvr!SAYip2e&-|&_E-WCTAC$MSw/>9uz=5CFN*bW^#e|{cVtv c#R');
define('NONCE_KEY',        'o5a;wUoJb[%VfnN7_N0+q?sX2<KB:Yx(}oM%i~NG}kinYLaRIM,9.i}a<?_KWR~X');
define('AUTH_SALT',        'M]5Acjsja@ivURGBK8dsmfi^P._Qq|ks3oB8AI~#&7|6/OoQQ20a.RAC(k!4-bn[');
define('SECURE_AUTH_SALT', '+4_F{t_(T:&$9Euks-NoM0{f_W~rba!c6{O-)nE z.<OY4vo``6,qO#%>LjD[z)U');
define('LOGGED_IN_SALT',   '/r|we~u#Fo2O/@NpGXP+XG4el;<^;|syv[vPe*HWYQQrsEgfZ`0@47P(7>J{2xxN');
define('NONCE_SALT',       'xDztPcCLd`x?9NeOa7MkCEM+#Kp1~QI+xAtUk0yW(Z2z<8ZHJeRuY|# ]txX$d!x');
/**#@-*/
/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'bhmrl_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', true );
/* Это всё, дальше не редактируем. Успехов! */
/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
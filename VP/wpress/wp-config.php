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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wpress' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '[:uHcf^<.K7oz6FE<Xb#9aNY94;^)1{?Wa:Mvvv]%8k jauY| XwC4EqRM346z+1' );
define( 'SECURE_AUTH_KEY',  '<KMEbh_ vbD;IrtOsI]&CpA+~pP>x`y 20V;J7K4NZ#lMg4_(*ucj.kR; c]ak@z' );
define( 'LOGGED_IN_KEY',    '}fS&bwanSqxZC$<Kb{^=PU-7aIWSb).Y&4&At Tka{l7Iw]mPHZ]Q-csFnjCQ_<!' );
define( 'NONCE_KEY',        '5XAM,Ma#yBkRh3@*i6+o:%hm-e4:,>E!CSz2n-/CRw9q?L(uJmQhMG>EOUcBkXIl' );
define( 'AUTH_SALT',        'z$a,7Q4f2wp8}0mQaudpx2{^wa3e9Pw~99%g)b%dE(zj3 y!o)EcAp.k0?VzD{>D' );
define( 'SECURE_AUTH_SALT', '&pWvH7XOm(9HUmfPT.R<YGM|a Hx]XBr.hwX;zTD19M5mO0%hDZ3xR92t$N@hBuw' );
define( 'LOGGED_IN_SALT',   'EprYmP~/rRy,P:`9kvIsMCxi?b:A7J.l?K3$h6 )>p!Lx#%0|sQ>QLD}zKaD9FdA' );
define( 'NONCE_SALT',       '=&q#*3#>Xl^m#n3_set| GJe;pfAxGC`#.!X/Wk:[zyJ>Uu(o`LIcWRb&7 l1,Y(' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );

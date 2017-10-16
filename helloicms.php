<?php
/**
 * Plugin Name: Hello Imagecms
 * Plugin URI: http://premmerce.com
 * Description: Первый модуль для ознакомления
 * Version: 1.0
 * Author: dev
 * Author URI: http://premmerce.com
 * License:      GPL-2.0+
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  domain-name
 * Domain Path:  /languages
 */
if (!defined('WPINC')) {
    die;
}

add_action('admin_menu', 'inHelloicms');
add_action('admin_menu', 'inHelloicmsSub');

function inHelloicms() {
    add_menu_page('Первый ознакомительный плагин Helloicms', 'Helloicms', 'manage_options', 'plugin-helloicms-admin', 'helloicmsMenu', 'dashicons-welcome-learn-more');
}

function inHelloicmsSub() {
    add_submenu_page(
            'plugin-helloicms-admin', 'Внутренний пункт Helloicms', 'Helloicms подменю', 'manage_options', 'plugin-helloicms-sub', 'helloicmsMenu');
}

function encode($string) {
    if (!$string) {
        return false;
    }
    return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}

function helloicmsMenu() {
    $input = [
        'helloicms_c_box' => encode(get_option('helloicms_c_box')),
        'helloicms_s_ct' => encode(get_option('helloicms_s_ct')),
        'helloicms_i_ut' => encode(get_option('helloicms_i_ut'))
    ];

    if (isset($_POST['helloicms'])) {

        foreach ($input as $k => $v) {

            if (isset($v) && isset($_POST['helloicms'][$k])) {

                update_option($k, trim($_POST['helloicms'][$k]));
            } elseif (!isset($v) && isset($_POST['helloicms'][$k])) {

                add_option($k, trim($_POST['helloicms'][$k]));
            } else {

                delete_option($k);
            }
            $input[$k] = encode(get_option($k));
        }
    }
    ?>
    <h2>Настройки</h2>
    <form method="POST">

        <input <?php if ($input['helloicms_c_box']): ?> checked="checked" <?php endif; ?> type="checkbox" value="1" name="helloicms[helloicms_c_box]"> : Чекбокс <br>

        <select name="helloicms[helloicms_s_ct]">
            <option selected="selected" value="0">Не выбрано</option>                
            <option <?php if ($input['helloicms_s_ct'] == 1): ?> selected="selected" <?php endif; ?> value="1">Выбор 1</option>
            <option <?php if ($input['helloicms_s_ct'] == 2): ?> selected="selected" <?php endif; ?> value="2">Выбор 2</option>
        </select>
        <br>
        <input type="text" name="helloicms[helloicms_i_ut]" value="<?php echo $input['helloicms_i_ut']; ?>"> <br>

        <input type="submit">
    </form>
    <?php
}

/**
 * На будущее
    global $wpdb;
    if (!class_exists('wpdb')) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php';
    }
    if (!$wpdb) {
        $wpdb = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
    }
    register_activation_hook(__FILE__, function() use($wpdb) {
        $wpdb->query("CREATE TABLE IF NOT EXISTS `wp_helloicms` ( "
                . "    `id` int(11) NOT NULL AUTO_INCREMENT, "
                . "    `name` varchar(255) CHARACTER SET utf8 NOT NULL, "
                . "    `settings` text CHARACTER SET utf8 NOT NULL, "
                . "    PRIMARY KEY (`id`) "
                . "  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
    });

    register_deactivation_hook(__FILE__, function() use($wpdb) {
        $wpdb->query("DROP TABLE wp_helloicms");
    });
 * 
 */

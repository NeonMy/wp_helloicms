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

if(!defined('WPINC')){
	die;
}

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

//call_user_func($callback);
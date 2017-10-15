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

include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php';
$wpdb = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);


register_activation_hook(__FILE__, function($wpdb) {
    var_dump($wpdb); exit;
});

//call_user_func($callback);
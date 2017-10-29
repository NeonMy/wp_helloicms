<?php

use helloicms\helloicmsPlugin;
use helloicms\FileManager;

/**
 * First Plugin plugin
 *
 *
 * @link              http://premmerce.com
 * @since             1.0.0
 * @package           helloicms
 *
 * @wordpress-plugin
 * Plugin Name:       First Plugin
 * Plugin URI:        http://premmerce.com
 * Description:       Icms plugin description
 * Version:           1.0
 * Author:            ad@min.com
 * Author URI:        http://premmerce.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       helloicms
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

call_user_func( function () {

	require_once plugin_dir_path( __FILE__ ) . 'autoload.php';

	$main = new helloicmsPlugin( new FileManager( __FILE__ ) );

	register_activation_hook( __FILE__, [ $main, 'activate' ] );

	register_deactivation_hook( __FILE__, [ $main, 'deactivate' ] );

	register_uninstall_hook( __FILE__, [ helloicmsPlugin::class, 'uninstall' ] );

	$main->run();
} );
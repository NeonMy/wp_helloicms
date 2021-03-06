<?php

/**
 * Register autoload callback
 */
spl_autoload_register( function ( $class ) {
	$namespace = 'helloicms\\';
	$source    = 'src\\';
	$class     = str_replace( $namespace, $source, $class );
	$file      = plugin_dir_path( __FILE__ ) . str_replace( '\\', DIRECTORY_SEPARATOR, $class ) . '.php';
	if ( file_exists( $file ) ) {
		require_once $file;
	}
} );
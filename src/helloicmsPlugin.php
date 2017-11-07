<?php namespace helloicms;

use helloicms\Admin\Admin;
use helloicms\Frontend\Frontend;
use helloicms\Post\Post;
use helloicms\Tax\Tax;

/**
 * Class helloicmsPlugin
 *
 * @package helloicms
 */
class helloicmsPlugin {

	/**
	 * @var FileManager
	 */
	private $fileManager;

	/**
	 * PluginManager constructor.
	 *
	 * @param FileManager $fileManager
	 */
	public function __construct( FileManager $fileManager ) {

		$this->fileManager = $fileManager;

        add_action('init', [ $this, 'loadTextDomain' ]);
	}

	/**
	 * Run plugin part
	 */
	public function run() {
		if ( is_admin() ) {
			new Admin( $this->fileManager );
		} else {
			new Frontend( $this->fileManager );
		}
        new Post( $this->fileManager );
        new Tax( $this->fileManager );
	}

    /**
     * Load plugin translations
     */
    public function loadTextDomain()
    {
        $name = $this->fileManager->getPluginName();
        load_plugin_textdomain($name, false, $name . '/languages/');
    }   

	/**
	 * Fired when the plugin is activated
	 */
	public function activate() {
		// TODO: Implement activate() method.
        
        flush_rewrite_rules();        
        
	}

	/**
	 * Fired when the plugin is deactivated
	 */
	public function deactivate() {
        
        flush_rewrite_rules();
        
		// TODO: Implement deactivate() method.
	}

	/**
	 * Fired during plugin uninstall
	 */
	public static function uninstall() {
		// TODO: Implement uninstall() method.
	}
}
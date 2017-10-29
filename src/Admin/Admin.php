<?php

namespace helloicms\Admin;

use helloicms\FileManager;

/**
 * Class Admin
 *
 * @package helloicms\Admin
 */
class Admin {

    /**
     * @var FileManager
     */
    private $fileManager;
    
    private $slug = '';

    /**
     * Admin constructor.
     *
     * Register menu items and handlers
     *
     * @param FileManager $fileManager
     */
    public function __construct(FileManager $fileManager) {
        $this->fileManager = $fileManager;
        $this->slug = $this->fileManager->getPluginName() . '-slug';

        self::initAdminMenu();
    }

    private function initAdminMenu() {
        add_action( 'admin_init', [$this, 'init_settings']);
        
        add_action('admin_menu', function () {
            self::menus(false, 'get_form');
        });
        
        
//        add_action('admin_menu', function () {
//            self::menus(true, 'subMenu');
//        });
        
    }

    private function menus($sub, $method) { 
        
        if ($sub) {
            // TODO: sub menu
            
        } else {
            add_menu_page(
                    $this->fileManager->getPluginName(), 
                    $this->fileManager->getPluginName(), 
                    'manage_options', 
                    'plugin-' . $this->fileManager->getPluginName(), 
                    function () use($method) {
                        self::$method();
                    }, 
                    'dashicons-welcome-learn-more');
            
        }
    }
    
    public function init_settings () {
        
        register_setting($this->fileManager->getPluginName() . '_integration', 'vendor_integration');        
        
        add_settings_section(
                    $this->fileManager->getPluginName() . '_section',
                    __('Posts Fields', 'helloicms'),
                    '',
                    $this->fileManager->getPluginName() . '_integration'               
                );
        
        add_settings_field(
                $this->fileManager->getPluginName() . '-text',
                __('Description', 'helloicms'),
                [$this, 'renderText'],
                $this->fileManager->getPluginName() . '_integration',
                $this->fileManager->getPluginName() . '_section',
                    [
                        'test' => 'test'
                    ]
                );
        

    }
    
    public function renderText($args){
		$this->fileManager->includeTemplate('admin/field-text.php', ['args' => $args]);
	}
    
    public function get_form() {
        $this->fileManager->includeTemplate('admin/helloicmsTemplate.php', ['options' => 1111111111]);        
    }

}

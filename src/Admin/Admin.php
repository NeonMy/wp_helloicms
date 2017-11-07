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
        
        add_action('admin_init', [$this, 'init_settings']);     

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
                    $this->fileManager->getPluginName(), $this->fileManager->getPluginName(), 'manage_options', 'plugin-' . $this->fileManager->getPluginName(), function () use($method) {
                self::$method();
            }, 'dashicons-welcome-learn-more');
        }
    }
    
    private function encode($string) {
        if (!$string) {
            return false;
        }
        return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
    }
    
    private function jsInit () {
        wp_register_script('shalom_script', $this->fileManager->locateAsset('admin/admin.js'), ['jquery']);
        wp_localize_script('shalom_script', 'data', [
            'w1' => __('My', 'helloicms'),
            'w2' => __('dear', 'helloicms'),
            'w3' => __('shalom', 'helloicms'),
        ]);
        wp_enqueue_script( 'shalom_script' );
        
    }
    
    private function cssInit () {
//        wp_register_style('shalom_style', $this->fileManager->locateAsset('admin/admin.css'));
        wp_enqueue_style('shalom_style', $this->fileManager->locateAsset('admin/admin.css'));
    }
    

    public function init_settings() {
        
        self::jsInit();
        self::cssInit();      
        
        $input = [
            'helloicms_c_box' => $this->encode(get_option('helloicms_c_box')),
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
                $input[$k] = $this->encode(get_option($k));
            }
        }

        register_setting($this->fileManager->getPluginName() . '_integration', 'vendor_integration');

        add_settings_section(
                $this->fileManager->getPluginName() . '_section', __('Posts Fields', 'helloicms'), '', $this->fileManager->getPluginName() . '_integration'
        );

        add_settings_field(
                $this->fileManager->getPluginName() . '-text', __('Description', 'helloicms'), [$this, 'renderText'], $this->fileManager->getPluginName() . '_integration', $this->fileManager->getPluginName() . '_section', [
            'name' => 'helloicms[helloicms_c_box]',
            'value' => $input['helloicms_c_box']
                ]
        );
    }

    public function renderText($args) {
        $this->fileManager->includeTemplate('admin/field-text.php', ['args' => $args]);
    }

    public function get_form() {
        $this->fileManager->includeTemplate('admin/helloicmsTemplate.php');
    }

}

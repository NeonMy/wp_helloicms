<?php

namespace helloicms\Meta;

use helloicms\FileManager;

/**
 * Class Meta
 *
 * @package helloicms\Meta
 */
class Meta {

    private $something_meta = 'something_meta';
    private $saveFields = [];

    /**
     * @var FileManager
     */
    private $fileManager;

    public function __construct(FileManager $fileManager) {
        $this->fileManager = $fileManager;
        $this->saveFields = ['textarea', 'textarea_side'];

        add_action('add_meta_boxes', [$this, 'metaBoxInitSide']);
        add_action('add_meta_boxes', [$this, 'metaBoxInit']);
        add_action('save_post', [$this, 'saveMeta']);
    }

    public function metaBoxInit() {
        add_meta_box('meta_box_orig', __('Other settings', 'helloicms'), 
            function ($data) {            
                self::getMetaData($data, 'textarea');                
            });
    }
    
    public function metaBoxInitSide() {
        add_meta_box('meta_box_side', __('Other settings side', 'helloicms'), 
            function ($data) {
                self::getMetaData($data, 'textarea_side');
            }, 'something', 'side');
    }

    public function saveMeta($id) {
        if ('something' == get_post_type($id)) {
            foreach ($this->saveFields as $field) {
                update_post_meta($id, $this->something_meta .$field, $_POST[$this->something_meta.$field]);                
            }
        }
    }
    
    private function getMetaData($data, $field) {        
        
        $args['value'] = get_post_meta($data->ID, $this->something_meta .$field, true);
        $args['name'] = $this->something_meta.$field;
        $args['ignoreShalom'] = TRUE;
        
        $this->fileManager->includeTemplate('admin/field-text.php', ['args' => $args]);           
        
    }

}

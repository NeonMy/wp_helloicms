<?php

namespace helloicms\Tax;

use helloicms\FileManager;

/**
 * Class Post
 *
 * @package helloicms\Post
 */
class Tax {

    /**
     * @var FileManager
     */
    private $fileManager;

    public function __construct(FileManager $fileManager) {
        $this->fileManager = $fileManager;

        add_action('init', [$this, 'videoPostTaxonomy']);
    }

    public function videoPostTaxonomy() {
        register_taxonomy(
                'something-tax', 'something', [
                    'label'   => __('Something taxonomy', 'helloicms'),
                    'rewrite' => ['slug' => 'something-tax'],
                    'public'  => TRUE,
                ]
        );
        
    }

}

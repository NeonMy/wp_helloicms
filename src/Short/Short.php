<?php

namespace helloicms\Short;

use helloicms\FileManager;

/**
 * Class Tax
 *
 * @package helloicms\Tax
 */
class Short {

    /**
     * @var FileManager
     */
    private $fileManager;

    public function __construct(FileManager $fileManager) {
        $this->fileManager = $fileManager;

//        add_action('init', [$this, 'helloicms_short']);
    }

    public function helloicms_short() {
        add_shortcode('tagAdd', function($a, $d, $t) {
            echo "<". $t ." data-attribute='{$a['data']}'>" . $d . "</". $t .">";
        });
    }

}

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

        add_action('init', [$this, 'helloicms_short']);
    }

    public function helloicms_short() {
        // [tagAdd tag="a" href="/testtest" style="color:red" close="1"]Ссылка куда-то[/tagAdd]
        add_shortcode('tagAdd', function($attributes, $body, $t) {

            $a = shortcode_atts(array(
                'tag' => 'br',
                'close' => '',
                    ), $attributes);

            unset($attributes['tag']);
            unset($attributes['close']);
            
            foreach ($attributes as $key => $val) {
                $attributes[$key] = $key.'="'.$val.'"';
            }            

            if ($a['close'] && $body){
                echo "<" . $a['tag'] . " " . implode(' ', $attributes) . ">" . $body . "</" . $a['tag'] . ">";
            } else {
                echo "<" . $a['tag'] . ">";                
            }

        });


//        shortcode_exists($tag)
    }

}

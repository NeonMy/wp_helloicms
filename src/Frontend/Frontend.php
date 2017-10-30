<?php namespace helloicms\Frontend;

use helloicms\FileManager;

/**
 * Class Frontend
 *
 * @package helloicms\Frontend
 */
class Frontend {


	/**
	 * @var FileManager
	 */
	private $fileManager;

	public function __construct( FileManager $fileManager ) {
		$this->fileManager = $fileManager;
        
        add_action( 'init', [$this, 'custom_post_type'] );
	}
    
    public function custom_post_type() {
        register_post_type('premmerce_video',
            [
                'labels'              => [
                    'name'          => __('Video'),
                    'singular_name' => __('Videos'),
                ],
                'public'              => true,
                'has_archive'         => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'menu_position'       => 5,
                'menu_icon'           => 'dashicons-admin-page',
                'show_in_admin_bar'   => true,
                'show_in_nav_menus'   => true,
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
            ]
        );
    }
    

}
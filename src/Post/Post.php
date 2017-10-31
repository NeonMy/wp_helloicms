<?php namespace helloicms\Post;

use helloicms\FileManager;

/**
 * Class Post
 *
 * @package helloicms\Post
 */
class Post {


	/**
	 * @var FileManager
	 */
	private $fileManager;

	public function __construct( FileManager $fileManager ) {
		$this->fileManager = $fileManager;      
        
        add_action( 'init', [ $this, 'videoPost'] );
        
	}
    
    public function videoPost () {
        register_post_type('something',
        [
            'labels'              => [
                'name'          => __('Somethings', 'helloicms'),
                'singular_name' => __('Something', 'helloicms'),
            ],
            'public'              => true,
            'has_archive'         => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 1,
            'menu_icon'           => 'dashicons-admin-page',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
        ]
    );
    }
    

}
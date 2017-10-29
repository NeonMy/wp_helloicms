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
	}

}
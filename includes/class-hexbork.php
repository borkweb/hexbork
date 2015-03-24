<?php

class Hexbork {
	public $version = 1;

	/**
	 * constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
	}//end __construct

	/**
	 * Hooked to the init action
	 */
	public function init() {
		$this->register_resources();
	}//end init

	/**
	 * Registers scripts and styles
	 */
	public function register_resources() {
		$template_url = get_template_directory_uri();

		wp_register_style(
			'foundation',
			"{$template_url}/css/foundation.css",
			array(),
			$this->version
		);

		wp_register_style(
			'app',
			"{$template_url}/css/app.css",
			array( 'foundation' ),
			$this->version
		);

		wp_register_script(
			'modernizr',
			"{$template_url}/bower_components/modernizr/modernizr.js",
			array(),
			$this->version
		);
	}//end register_resources

	/**
	 * Hooked to the wp_enqueue_scripts action
	 */
	public function wp_enqueue_scripts() {
		wp_enqueue_style( 'app' );

		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'jquery' );
	}//end wp_enqueue_scripts
}//end class

/**
 * singleton function
 */
function hexbork() {
	global $hexbork;

	if ( ! $hexbork ) {
		$hexbork = new Hexbork;
	}//end if

	return $hexbork;
}//end hexbork

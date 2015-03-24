<?php

class Hexbork {
	/**
	 * constructor
	 */
	public function __construct() {
	}//end __construct
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

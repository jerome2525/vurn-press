<?php
/**
 * This file controls contains any customizations to the
 * footer area of the theme.
 *
 * @since  1.0.0 
 * 
 * @package Vsellis
 */

class Footer {
	
	public function __construct() {

		//add_action( 'genesis_footer', array( $this, 'vsellis_footer' ), 15 );

	}

	public function vsellis_footer() {

		echo"<p class='test-class'>jerome was here</p>";
		
	}

}

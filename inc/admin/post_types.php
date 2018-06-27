<?php

class Post_Types {

	public function __construct() {
		$this->load_includes();
		$this->create_post_types();
	}

	public function load_includes() {
		if ( file_exists( get_stylesheet_directory() . '/lib/CPT.php' ) ) {
			require get_stylesheet_directory() . '/lib/CPT.php';
		}
	}

	public function create_post_types() {

		$property = new CPT(
			array(
				'post_type_name' => 'property',
				'singular' => 'Property',
				'plural' => 'Properties',
				'slug' => 'property',
			), 
			array(
				'supports' => array( 'title', 'editor', 'thumbnail', 'comments' )
			)
		);
		
		$property->menu_icon( 'dashicons-admin-home' );
		$property->register_taxonomy( 'property-type' );
	}

}

		
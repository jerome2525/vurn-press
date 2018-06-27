<?php
/**
 * Front Page template
 *
 * @package Vurn Press Pro
 * @author Jerome Anyayahan
 * @subpackage Customizations
 */

class Front_Page {

	public function __construct() {

		$this->load_hooks();
		
	}

	public function load_hooks() {

		// Add front-page body class.
		add_filter( 'body_class', array( $this, 'front_page_body_class' ) );

		// Force full width content layout.
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		// Remove breadcrumbs.
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		// Remove the default Genesis loop.
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		add_action( 'genesis_after_header', array( $this, 'display_section' ) );

	}

	public function front_page_body_class( $classes ) {

		$classes[] = 'front-page';
		return $classes;

	}

	public function display_section() {

		if( have_rows( 'field_page_composer' ) ) {
		    while ( have_rows( 'field_page_composer' ) ) {
		    	the_row();

		        if( get_row_layout() == 'hero_search' ) {
		        	$title = get_sub_field( 'hero_title' );
		        	$bg_image = get_sub_field( 'hero_background_image' );
		        	$bg_color = get_sub_field( 'hero_background_color' );
		        	$description = get_sub_field( 'hero_description' );
		        	$ajxurl = site_url()."/wp-admin/admin-ajax.php";
		        	include( locate_template( 'front-page-templates/hero-search.php', false, false ) ); 
		        	include( locate_template( 'front-page-templates/property-listing.php', false, false ) ); 
		        }
		        elseif( get_row_layout() == 'tester' ) {
		        }
		    }
		}    
		else {
			echo '<h3>It seems that you dont have any row added yet! Please add!</h3>';
		}

	}

}

$front_page = new Front_Page;

//* Run Genesis.
genesis();

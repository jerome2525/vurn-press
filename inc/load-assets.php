<?php

//* Load Stylesheets
class Load_Assets {

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css_js' ) );

	}

	public function enqueue_css_js() {

		$version = wp_get_theme()->Version;

	    //* Load Styles
		wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		
		wp_enqueue_style( 'google-font', 'https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Roboto:300,300i,400,500,700,900' );

	    //* Load Scripts
		wp_enqueue_script( 'map-js', 'https://maps.google.com/maps/api/js?key=AIzaSyBvCcOImlnjcG_jpyF1dROsJTmvygsMBRU&sensor=false&language=en&libraries=places');

		wp_enqueue_script( 'google-auto-complete', 'https://cdnjs.cloudflare.com/ajax/libs/geocomplete/1.7.0/jquery.geocomplete.js', array('jquery'), $version, true );

		wp_enqueue_script( 'main', CHILD_URL . '/js/custom/main.js', array('jquery'), $version, true );

	}

}
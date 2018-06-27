<?php
/**
 * This files loads the genesis framework
 * @package cheddars
 */

// Priority 15 ensures it runs after Genesis itself has setup.
class Init {

	public function __construct() {

		add_action( 'genesis_setup', array( $this, 'setup' ), 15 );

	}

	public function setup() {

		// Child theme (do not remove).
		define( 'CHILD_THEME_NAME', 'Vurn Press' );
		define( 'CHILD_THEME_URL', 'http://wp-needs.com/' );
		define( 'CHILD_THEME_VERSION', '0.0.1' );

		add_theme_support( 'genesis-responsive-viewport' );
		add_theme_support( 'genesis-after-entry-widget-area' );
		add_theme_support( 'html5' );
		add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'inner', 'footer-widgets', 'footer' ) );
		remove_theme_support( 'genesis-menus' );
		add_theme_support( 'genesis-footer-widgets', 3 );

		genesis_unregister_layout( 'content-sidebar-sidebar' );
		genesis_unregister_layout( 'sidebar-sidebar-content' );
		genesis_unregister_layout( 'sidebar-content-sidebar' );

		add_filter( 'genesis_edit_post_link', '__return_false' );

		unregister_sidebar( 'sidebar-alt' );

		add_action( 'init', array( $this, 'add_sidebars' ) );

		// Add support for custom logo.
		add_theme_support( 'custom-logo', array(
			'width'			=> 351,
			'height'		=> 120,
			'flex-width'	=> true,
			'flex-height'	=> true,
		) );

		add_filter( 'genesis_attr_site-description', array( $this, 'add_site_description_class') );

		add_filter( 'genesis_seo_title', array( $this, 'inline_logo' ), 10, 3 );

		if ( function_exists( 'add_image_size' ) ) { 
			add_image_size( 'property-list', 500, 300, true );
		}
		
	}


	public function add_sidebars() {

		genesis_register_sidebar( array(
				'id'          => 'slider-area',
				'name'        => __( 'Slider Areas', 'simple' ),
				'description' => __( 'This slider area is located on the homepage.', 'simple' ),
			)
		);

		genesis_register_sidebar( array(
				'id'          => 'social-footer',
				'name'        => __( 'Social Footer', 'simple' ),
				'description' => __( 'This slider area is located in the footer.', 'simple' ),
			)
		);

		genesis_register_sidebar( array(
				'id'          => 'front-page-1',
				'name'        => __( 'Front page', 'simple' ),
				'description' => __( 'This is located at the Front page.', 'simple' ),
			)
		);

	}

	public function inline_logo( $title, $inside, $wrap ) {

		// If the custom logo function and custom logo exist, set the logo image element inside the wrapping tags.
		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
			$inside = sprintf( '<span class="screen-reader-text">%s</span>%s', esc_html( get_bloginfo( 'name' ) ), get_custom_logo() );
		} else {
			// If no custom logo, wrap around the site name.
			$inside	= sprintf( '<a href="%s">%s</a>', trailingslashit( home_url() ), esc_html( get_bloginfo( 'name' ) ) );
		}

		// Build the title.
		$title = genesis_markup( array(
			'open'    => sprintf( "<{$wrap} %s>", genesis_attr( 'site-title' ) ),
			'close'   => "</{$wrap}>",
			'content' => $inside,
			'context' => 'site-title',
			'echo'    => false,
			'params'  => array(
				'wrap' => $wrap,
			),
		) );

		return $title;

	}

	public function add_site_description_class( $attributes ) {

		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
			$attributes['class'] .= ' screen-reader-text';
		}

		return $attributes;
		
	}


}




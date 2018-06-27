<?php
/**
 * Define the metabox and field configurations.
 */
class Meta_Boxes {

	public function __construct() {

		$this->load_includes();
		$this->load_hooks();
		$this->create_theme_option();
		$this->create_builder_fields();

	}

	public function load_includes() {

		if ( file_exists( get_stylesheet_directory() . '/lib/acf/acf.php' ) ) {
			require get_stylesheet_directory() . '/lib/acf/acf.php';
		}

	}

	public function load_hooks() {

		add_filter('acf/settings/path', array( $this, 'new_acf_settings_path') );
		add_filter('acf/settings/dir', array( $this, 'new_acf_settings_dir') );
		//add_filter('acf/settings/show_admin', '__return_false' );

	}
	 
	public function new_acf_settings_path( $path ) { 

	    $path = get_stylesheet_directory() . '/lib/acf/';
	    return $path;    

	}
	 
	public function new_acf_settings_dir( $dir ) {

	    $dir = get_stylesheet_directory_uri() . '/lib/acf/';
	    return $dir;

	}

	public function create_builder_fields() {

		// Start Frontpage fields
		acf_add_local_field_group(array(
			'key' => 'front_builder',
			'title' => 'Front Page Builder',
			'fields' => array (
				array (
					'key' => 'field_page_composer',
					'label' => '',
					'name' => 'page_composer',
					'type' => 'flexible_content',
					'layouts' => array (
						array (
							'label' => 'Hero Search',
							'name' => 'hero_search',
							'display' => 'row',
							'min' => '',
							'max' => '',
							'sub_fields' => array(
								array(
									'key'   => 'hero_title',
									'label' => 'Title',
									'name'  => 'hero_title',
									'type'  => 'text',
								),
								array(
									'key'   => 'hero_background_image',
									'label' => 'Background Image',
									'name'  => 'hero_background_image',
									'type'  => 'image',
									'return_format' => 'url'
								),
								array(
									'key'   => 'hero_background_color',
									'label' => 'Background Color',
									'name'  => 'hero_background_color',
									'type'  => 'color_picker',
									'return_format' => 'string'
								),
								array(
									'key'   => 'hero_description',
									'label' => 'Description',
									'name'  => 'hero_description',
									'type'  => 'wysiwyg',
								),
							),
						),
						array (
							'label' => 'Latest By Category',
							'name' => 'latest_by_category',
							'display' => 'row',
							'min' => '',
							'max' => '',
							'sub_fields' => array (),
						),
					),
					'button_label' => 'Add Section',
					'min' => '',
					'max' => '',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'page_type',
						'operator' => '==',
						'value' => 'front_page',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'acf_after_title',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => array('the_content'),
		));
		// End Frontpage Fields

		// Start Theme option
		acf_add_local_field_group( array (
			'key'      => 'theme_option_group',
			'title'    => 'Theme Option',
			'location' => array (
				array (
					array (
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'theme-general-settings',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
		) );

		acf_add_local_field( array(
			'key'          => 'header_tab',
			'label'        => 'Header',
			'name'         => 'header_tab',
			'type'         => 'tab',
			'parent'       => 'theme_option_group',
			'instructions' => '',
			'required'     => 1,
		) );

		acf_add_local_field( array(
			'key'          => 'header_menu',
			'label'        => 'Header Menu',
			'name'         => 'header_menu',
			'type'         => 'text',
			'parent'       => 'theme_option_group',
			'instructions' => '',
			'required'     => 1,
		) );
		// End Theme option

		// Start Property fields
		acf_add_local_field_group( array (
			'key'      => 'property_fields',
			'title'    => 'Property Fields',
			'location' => array (
				array (
					array (
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'property',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
		) );

		acf_add_local_field( array(
			'key'          => 'property_details_tab',
			'label'        => 'Details',
			'name'         => 'property_details_tab',
			'type'         => 'tab',
			'parent'       => 'property_fields',
			'instructions' => '',
			'required'     => 1,
		) );

		acf_add_local_field( array(
			'key'          => 'price',
			'label'        => 'Price',
			'name'         => 'price',
			'type'         => 'number',
			'parent'       => 'property_fields',
			'instructions' => '',
			'required'     => 1,
			'min'	=> 0
		) );

		acf_add_local_field( array(
			'key'          => 'saleprice',
			'label'        => 'Sale Price',
			'name'         => 'saleprice',
			'type'         => 'number',
			'parent'       => 'property_fields',
			'instructions' => '',
			'required'     => 0,
			'min'	=> 0
		) );

		acf_add_local_field( array(
			'key'          => 'address',
			'label'        => 'Address',
			'name'         => 'address',
			'type'         => 'text',
			'parent'       => 'property_fields',
			'instructions' => '',
			'required'     => 1,
		) );

		acf_add_local_field( array(
			'key'          => 'city',
			'label'        => 'City',
			'name'         => 'city',
			'type'         => 'text',
			'parent'       => 'property_fields',
			'instructions' => '',
			'required'     => 1,
		) );

		acf_add_local_field( array(
			'key'          => 'state',
			'label'        => 'State',
			'name'         => 'state',
			'type'         => 'text',
			'parent'       => 'property_fields',
			'instructions' => '',
			'required'     => 1,
		) );

		acf_add_local_field( array(
			'key'          => 'zip',
			'label'        => 'Zip',
			'name'         => 'zip',
			'type'         => 'text',
			'parent'       => 'property_fields',
			'instructions' => '',
			'required'     => 1,
		) );

		acf_add_local_field( array(
			'key'          => 'country',
			'label'        => 'Country',
			'name'         => 'country',
			'type'         => 'text',
			'parent'       => 'property_fields',
			'instructions' => '',
			'required'     => 1,
		) );

		acf_add_local_field( array(
			'key'          => 'square_feet',
			'label'        => 'Square Feet',
			'name'         => 'square_feet',
			'type'         => 'text',
			'parent'       => 'property_fields',
			'instructions' => '',
			'required'     => 1,
		) );

		acf_add_local_field( array(
			'key'          => 'bedrooms',
			'label'        => 'bedrooms',
			'name'         => 'bedrooms',
			'type'         => 'number',
			'parent'       => 'property_fields',
			'instructions' => '',
			'required'     => 1,
			'min'	=> 0
		) );

		acf_add_local_field( array(
			'key'          => 'bathrooms',
			'label'        => 'bathrooms',
			'name'         => 'bathrooms',
			'type'         => 'number',
			'parent'       => 'property_fields',
			'instructions' => '',
			'required'     => 1,
			'min'	=> 0
		) );

		// End Property Fields
		
	}

	public function create_theme_option() {

		if( function_exists('acf_add_options_page') ) {
	
			acf_add_options_page(array(
				'page_title' 	=> 'Theme General Settings',
				'menu_title'	=> 'Theme Settings',
				'menu_slug' 	=> 'theme-general-settings',
				'capability'	=> 'edit_posts',
				'redirect'		=> false
			));
			
		}
	}

}
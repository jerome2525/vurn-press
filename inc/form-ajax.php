<?php

class Form_Ajax {

    public function __construct() {
        $this->load_hooks();
    }

    public function load_hooks() {
        add_action( 'wp_ajax_wsfilter', array( $this, 'display_result' ) ); 
        add_action( 'wp_ajax_nopriv_wsfilter', array( $this, 'display_result' ) );
    }

    public function display_result() {
        if( isset( $_POST['action'] ) ) {
            $ptype = $_POST['post_type'];
            $property_type = $_POST['property_type'];
            $beds = $_POST['bedrooms'];
            $paged = $_POST['pagination'];
            $min = $_POST['min'];
            $max = $_POST['max'];
            $street_number = $_POST['street_number'];
            $route = $_POST['route'];
            $address = "$street_number $route";
            $state = $_POST['administrative_area_level_1'];
            $postal_code = $_POST['postal_code'];
            $country = $_POST['country'];
            
            $Post_Type_List = new Post_Type_List;
            $Post_Type_List->display_list( $ptype, $posts_per_page, $offset, $property_type, $beds , $min, $max, $paged, $address, $state, $postal_code, $country );  
            die();
        }
        
    }

}



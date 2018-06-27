<?php
// add a custom function that you can use anywhere!!
class Reusable {

	public function term_dropdown_list( $term_slug ) {
		$tax_business_cat = get_terms( $term_slug, array( 'fields' => 'all' ) );
		if ( !empty( $tax_business_cat ) ) {
			foreach( $tax_business_cat as $term ) {
				$name = $term->name;
				$id = $term->term_id;
				$link = esc_url( get_term_link( $term ) );
				echo '<option value="'.$name.'">'.$name.'</option>';
			}
		}
	}
	
}
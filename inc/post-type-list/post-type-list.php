<?php

class Post_Type_List {

	public function display_list( $ptype = 'post', $posts_per_page = 6 , $offset = 0, $property_type = null, $beds = null, $min = null, $max = null, $paged = null, $address = null, $state = null, $postal_code = null, $country = null ) {
		if( empty( $paged ) ) {
			$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		}
		$args = array(
			'post_type'		=> $ptype,
			'post_status'	=> 'publish',
			'posts_per_page' => $posts_per_page,
			'offset'	=> $offset,
			'paged'	=> $paged
		);

		if( !empty( $property_type ) ) {

	        $tax_query[] = array(
	            'taxonomy' => 'property-type',
	            'field' => 'name',
	            'terms' => $property_type
	        );

	        $args['tax_query'] = $tax_query;
	    }

	    if( !empty( $beds ) ) {
			$meta_query[] = array(
				'relation' => 'AND',
				array(
					'key'=>'bedrooms',
					'value' => $beds, 
					'compare' => '='
				)
			);
		}

		if( !empty( $min && $max ) ) {

			$meta_query[] = array(
				'relation' => 'AND',
				array(
					'key'	=>	'price',
					'value' => array( $min, $max ), 
					'compare' => 'BETWEEN',
					'type'	=> 'NUMERIC'
				)
			);
		}

		if( !empty( $address ) ) {
			$meta_query[] = array(
				'relation' => 'AND',
				array(
					'key'=>'address',
					'value' => $address, 
					'compare' => 'LIKE'
				)
			);
		}

		if( !empty( $state ) ) {
			$meta_query[] = array(
				'relation' => 'AND',
				array(
					'key'=>'state',
					'value' => $state, 
					'compare' => 'LIKE'
				)
			);
		}

		if( !empty( $postal_code ) ) {
			$meta_query[] = array(
				'relation' => 'AND',
				array(
					'key'=>'zip',
					'value' => $postal_code, 
					'compare' => 'LIKE'
				)
			);
		}

		if( !empty( $country ) ) {
			$meta_query[] = array(
				'relation' => 'AND',
				array(
					'key'	=>	'country',
					'value' =>	$country, 
					'compare' => 'LIKE'
				)
			);
		}

	    if( !empty( $beds || $min || $max || $address || $state || $postal_code || $country ) ) {
	        $args['meta_query'] = $meta_query;
	    }

		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {

				$query->the_post();
				$headline = get_the_title();
				$content =  wp_filter_nohtml_kses( get_the_content() );
				$content = strip_shortcodes( $content );
				$content = $this->ShortenText( $content, 130 ); 
				$content  = stripslashes( $content );
				$link =  get_permalink();
				$categories = get_the_category( get_the_ID() );
				$author = get_the_author();
				$authorpic = get_avatar( get_the_author_meta( 'ID' ), 32 );
				$authorurl = get_author_posts_url( get_the_author_meta( 'ID' ) );
				$date_1 = current_time( 'mysql' );
				$date_2 = get_the_date( 'F j, Y', get_the_ID() ); 
				$date_diff = $this->dateDifference( $date_1 , $date_2 , '%d' );
				if( !empty( get_field( 'saleprice' ) ) ) {
					$price = get_field( 'saleprice' );
				}
				else {
					$price = get_field( 'price' );
				}

				if( !empty( get_field( 'saleprice' ) ) ) {
					$label = 'Sale!'; 
				}
				else {
					if( !empty( $date_diff <= 3 ) ) {
						$label = 'New!'; 
					}
					else {
						$label = '';
					}
				}

				if ( ! empty( $categories ) ) {
					$catname = esc_html( $categories[0]->name );   
					$catlink = esc_url( get_category_link( $categories[0]->term_id ) );
				}
				
				include( locate_template( 'inc/post-type-list/post-type-list-template.php', false, false ) ); 
			}

			wp_reset_postdata();
			
			echo"<div class='paginate-bg'>";
					$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => $paged,
						'total' => $query->max_num_pages,
						'prev_text' => __('<i class="fa fa-angle-left"></i>'),
						'next_text' => __('<i class="fa fa-angle-right"></i>'),
					) );	
			echo"</div>";
		}
		else {
			echo '<h3>No Result Found!</h3>';
		}

	}

	public function ShortenText( $text, $chars_limit ) { 
		$chars_text = strlen($text);
		$text = $text." ";
		$text = substr($text,0,$chars_limit);
		$text = substr($text,0,strrpos($text,' '));
		if ( $chars_text > $chars_limit ) { 
			$text = $text."..."; 
		}
		return $text;
	}

	public function dateDifference( $date_1 , $date_2 , $differenceFormat = '%a' ) {
		$datetime1 = date_create( $date_1 );
		$datetime2 = date_create( $date_2 );
	    
		$interval = date_diff( $datetime1, $datetime2 );
	    
		return $interval->format( $differenceFormat );   
	}

}
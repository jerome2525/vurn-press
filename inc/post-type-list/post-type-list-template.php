<div class="property-list property-id-<?php echo get_the_ID();?>">
	<?php if ( has_post_thumbnail() ) { ?>
		<a href="<?php echo $link; ?>"><?php the_post_thumbnail( 'property-list' ); ?></a>
	<?php } ?>
	<?php if( !empty( $price ) ) { 
		$formatted = number_format_i18n( $price );
		echo '<span class="price">$ '.$formatted.'</span>'; 
	} 
	?>
	<?php if( !empty( $label ) ) { ?>
		<span class="listing-text"><?php echo $label; ?></span>
	<?php } ?>	
	<div class="inner">
		<?php if( !empty( $headline ) ){ ?>
			<h3><?php echo $headline; ?></h3>
		<?php } ?>
		<?php if( !empty( get_field( 'city' ) || get_field( 'state' ) || get_field( 'zip' ) ) ) { ?> 
			<span class="address">
				<?php 
					if( !empty( get_field('city') ) ) {
						echo get_field('city').', '; 
					}
				?>
				<?php 
					if( !empty( get_field('state') ) ) {
						echo get_field('state').' '; 
					}
				?>
				<?php 
					if( !empty( get_field('zip') ) ) {
						echo get_field('zip'); 
					}
				?>
			</span>
			<?php if( !empty( $link ) ) {
				echo '<a href="'.$link.'" class="more">View Property</a>';
			} ?>
		<?php } ?>
	</div>
</div>
<div class="hero" style="<?php if( !empty( $bg_image ) ) { echo 'background-image: url('.$bg_image.');'; } if( !empty( $bg_color ) ) { echo 'background-color:'.$bg_color.';'; } ?>">
	<div class="wrap">
		<section class="headline">
			<div class="widget-wrap">
				<?php if( !empty( $title ) ) { ?>
					<h1 class="widget-title"><?php echo $title; ?></h1>
				<?php } ?>	
				<?php if( !empty( $description ) ) { ?>
					<p><?php echo $description; ?></p>
				<?php } ?>
				<form action="<?php echo $ajxurl; ?>" method="POST" class="filter" id="filterform">
					<input type="hidden" name="action" value="wsfilter">
					<input type="hidden" name="post_type" value="property">
					<input type="hidden" name="pagination" value="1" id="pagival">
					<div class="row-1">
						
						<input type="text" name="address" placeholder="Enter address e.g. street, city and state or zip" id="address" class="input map-input">
						<select name="property_type" id="types" class="input">
							<option value="" selected="selected">Types</option>
							<?php
								$reusable = new Reusable;
								$term_slug = 'property-type';
								$reusable->term_dropdown_list( $term_slug );
							?>
						</select>
						
					</div>
					
					<div class="row-2">
						<input type="number" name="bedrooms" id="bedrooms" class="input" min="1" placeholder="No. of Bedrooms">
						<input type="number" name="min" placeholder="Min Price" min="1" class="input">
						<input type="number" name="max" placeholder="Max Price" min="1" class="input">
						<input type="submit" id="searchsubmit" class="btn input" value="Search">	
					</div>

        			<input name="route" type="hidden" value="" class="hidden">
        			<input name="street_number" type="hidden" value="" class="hidden">
        			<input name="administrative_area_level_1" type="hidden" value="" class="hidden">
			        <input name="postal_code" type="hidden" value="" class="hidden">
        			<input name="country" type="hidden" value="" class="hidden">


				</form>
			</div>
		</section>

	</div>
</div>
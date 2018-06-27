<div class="hero-listing">
	<div class="loader"></div>
	<div class="wrap" id="result">
		<?php 
			$ptype = 'property';
			$Post_Type_List = new Post_Type_List;
			$Post_Type_List->display_list( $ptype ); 
		?>
	</div>
</div>
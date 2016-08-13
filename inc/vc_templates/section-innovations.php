<?php

	extract( shortcode_atts( array(
    	'category' => 356
	), $atts ) );

?>
<div class="innovations">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				
				<ul class="insights-grid-content-list">
					
				<?php
				
					$args = array(
						'post_type' => 'post', 
						'posts_per_page' => 9999, 
						'orderby' => 'date', 
						'order' => 'DESC',
						'category__in' => $atts['category']
					);
					
					$count = 0;
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					
						$categories = get_the_category();
						$cat = '';
						foreach($categories as $category){
							$cat = $category->cat_name;
						}
						if( get_post_type() == 'infographics' ){
							$cat = 'infographic';
						}
					
				?>
				
					<li>
						<a href="<?php echo get_permalink(); ?>"><?php echo the_title() ?></a>
					</li>
				<?php
					$count++;
					endwhile; 
					wp_reset_query();
				?>
				</ul>
				
			</div>
		</div>
	</div>
</div>




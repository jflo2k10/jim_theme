
<section>

	<div class="container-fluid">
		
		<div class="row">
			
			<div class="col-sm-12 col-md-4 library-options">
				
				<h3>PRODUCT TYPE</h3>
				<ul>
			        <?php 
			        $terms = get_terms( 'software-tag' );
			        foreach($terms AS $term){
			        	$link = get_term_link( $term );
			        	echo '<li><a href="' . $link . '" data-filter="' . $term->term_id . '">' . $term->name . '</a></li>';
			        }
					?>
					<li><a href="#" class="all-categories" data-filter="">all categories</a></li>
				</ul>
				<!--
				<h3>COST</h3>
				<ul>
			        <li><a href="#" data-filter="free">no cost</a></li>
			        <li><a href="#" data-filter="$">low cost</a></li>
			        <li><a href="#" data-filter="$$">medium cost</a></li>
			        <li><a href="#" data-filter="$$$">expensive</a></li>
			        <li><a href="#" data-filter="">all price levels</a></li>
				</ul>
				-->
			</div>
			<div class="col-sm-12 col-md-8 library-items">
				
				<div class="row">
				<?php
					$args = array( 'post_type' => array('software'), 'posts_per_page' => 25, 'orderby' => 'menu_order', 'order' => 'ASC');
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					
				?>
					<div class="col-sm-12 col-md-6">
						
						<div class="library-item">
						
							<?php echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>'; ?>
							
							<small>
							<?php 
							$term_list = array();
							$terms = wp_get_post_terms(get_the_id(), 'software-tag'); 
							foreach($terms AS $term){
								$term_list[] = $term->name;
							}
							echo join(', ', $term_list); 
							?>
							</small>
							
							<?php
								$image_url = get_field('listing_image');
								$image_url = $image_url['url'];
								echo '<div class="library-items-img"><a href="' . get_permalink() . '"><img src="' . $image_url . '" alt="' . get_the_title() . '" /></a></div>';
							?>
							
							<p><?php the_field('short_description'); ?></p>
						
						</div>
						
					</div>
				<?php 
					endwhile; 
				?>
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	<div class="container-fluid">
		
		<div id="resources-load-more">
			<a href="#">Load More Softwares</a>
			<p>We've listed tons of great tools.</p>
		</div>
		
		<div id="article-sharing">
            <span class='st_sharethis_vcount' displayText='ShareThis'></span>
        	<span class='st_email_vcount' displayText='Email'></span>
			<span class='st_linkedin_vcount' displayText='LinkedIn'></span>
            <span class='st_twitter_vcount' displayText='Tweet'></span>
            <span class='st_facebook_vcount' displayText='Facebook'></span>
            <span class='st_plusone_vcount' ></span>
        </div>
        
        <script type="text/javascript">var switchTo5x=true;</script><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher:'4f46efcc-9f9e-45b7-af09-9b8bb76f5a30'});</script>
		
	</div>

</section>

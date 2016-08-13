
<div class="insights-grid-events grey-background">
	
	<div class="container-fluid">
		
		<div class="col-sm-6 col-xs-12 insights-grid-event-date">
			<?php
				$args = array( 'post_type' => 'seminar', 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'DESC', 
					'meta_query' => array(
						array('key' => 'registration_status', 'value' => 'closed', 'compare' => '!=')
					),
					'tax_query' => array(
						array(
							'taxonomy' => 'event-type',
							'field'    => 'term_id',
							'terms'    => array( 333 )
						),
					)
				);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
			?>
			<div class="heading">Seminar</div>
			<div class="insights-grid-event-date-info">
				<div class="insights-grid-event-month"><?php echo date('F Y', strtotime(get_field('event_date'))) ?></div>
				<strong><?php echo date('d', strtotime(get_field('event_date'))) ?></strong>
			</div>
			<h2 class="insights-grid-event-title"><a href="<?php echo get_permalink(); ?>"><?php echo the_title() ?></a></h2>
			<p><?php echo the_excerpt() ?></p>
			
			<div><a class="btn smaller" href="<?php echo get_permalink(); ?>">Seminar Details + Registration</a></div>
			<?php endwhile; ?>
		</div>
		
		<div class="col-sm-6 col-xs-12 insights-grid-event-date">
			<?php
				$args = array( 'post_type' => 'seminar', 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'DESC', 
					'meta_query' => array(
						array('key' => 'registration_status', 'value' => 'closed', 'compare' => '!=')
					),
					'tax_query' => array(
						array(
							'taxonomy' => 'event-type',
							'field'    => 'term_id',
							'terms'    => array( 336 )
						),
					)
				);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
			?>
			<div class="heading">Two Hour Workshop</div>
			<div class="insights-grid-event-date-info">
				<div class="insights-grid-event-month"><?php echo date('F Y', strtotime(get_field('event_date'))) ?></div>
				<strong><?php echo date('d', strtotime(get_field('event_date'))) ?></strong>
			</div>
			<h2 class="insights-grid-event-title"><a href="<?php echo get_permalink(); ?>"><?php echo the_title() ?></a></h2>
			<p><?php echo the_excerpt() ?></p>
			
			<div><a class="btn smaller" href="<?php echo get_permalink(); ?>">Workshop Details + Registration</a></div>
			<?php endwhile; ?>
		</div>
	</div>
		
</div>

<div class="insights-grid-videos">
	<div class="container">
		<div class="text-center row">
			<p class="heading">Videos</p>
		</div>
		<div class="row">

			<div class="col-sm-12">
				<div class="row">
				<?php
				
					$args = array(
						'post_type' => 'post', 
						'posts_per_page' => 12, 
						'orderby' => 'date', 
						'order' => 'DESC',
						'category__in' => array(53)
					);
					
					$count = 0;
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					
						$categories = get_the_category();
						$cat = '';
						foreach($categories as $category){
							$cat = $category->cat_name;
						}
						
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'medium' );
						
						?>
							<div class="insights-grid-videos-item col-sm-12 col-md-4">
								<?php if( !empty($image_url[0]) ){ ?>
								<a class="videos-item-img" href="<?php echo get_permalink(); ?>" style="background-image:url(<?php echo $image_url[0]; ?>)"><?php echo the_title() ?></a>
								<?php } ?>
								<a href="<?php echo get_permalink(); ?>"><?php echo the_title() ?></a>
							</div>
						<?php
							

					$count++;
					endwhile; 
					wp_reset_query();
				?>
				</div>
				<div class="row">
					<p class="more-videos text-center">
						<a class="btn" href="/category/posts/videos/">More Videos</a>
					</p>
				</div>
				
			</div>
		</div>
	</div>
</div>


<div class="insights-grid-infographics">
	<div class="container">
		<div class="row text-white text-center">
			
			<p class="heading">Infographics</p>
			
		</div>
		<ul class="row featured-infographics">
		<?php
			$args = array( 'post_type' => 'infographics', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC');
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
					
				$infographic = get_field('infographic', get_the_id());
		?>
			<li class="col-sm-12 col-md-4">
			<a href="<?php echo get_permalink(); ?>" data-postid="<?php echo get_the_id(); ?>">
				<img class="latest-infographic-img" src="<?php echo $infographic['url']; ?>" style="width:100%;" />
			</a>
			</li>
		<?php
			endwhile; 
			wp_reset_query();
		?>
		</ul>
		<div class="row">
			<p class="text-center">
				<a class="btn-white" href="/infographics">More Infographics</a>
			</p>
		</div>
	</div>
</div>

<div class="insights-grid-content blue-background">
	<div class="container">
		<div class="text-white text-center row">
			<p class="heading">Articles</p>
		</div>
		<div class="row">
			
			<div class="insights-grid-content-sidebar col-sm-12 col-md-3">
				<h2>TOPICS</h2>
				<ul>
					<li><a href="/tag/branding/">Branding</a></li>
					<li><a href="/tag/lead-generation/">Lead Generation</a></li>
					<li><a href="/tag/search-ppc/">Search &amp; Advertising</a></li>
					<li><a href="/tag/social-media/">Social Media</a></li>
					<li><a href="/tag/lead-conversion/">Lead Conversion</a></li>
					<li><a href="/tag/website-design/">Website Design</a></li>
					<li><a href="/tag/marketing-automation/">Marketing Automation</a></li>
					<li><a href="/tag/sales-tools/">Sales Tools</a></li>
				</ul>
				<br /><br />
				<h2>INDUSTRIES</h2>
				<ul>
					<li><a href="/category/posts/professional-services/">Professional Services</a></li>
					<li><a href="/category/posts/manufacturing/">Manufacturing</a></li>
					<li><a href="/category/posts/software-start-ups/">Software &amp; Start-Ups</a></li>
					<li><a href="/category/posts/travel-entertainment/">Travel &amp; Entertainment</a></li>
				</ul>
			</div>
			
			<div class="col-sm-12 col-md-8 col-md-offset-1">
				<?php
				
					$args = array(
						'post_type' => 'post', 
						'posts_per_page' => 12, 
						'orderby' => 'date', 
						'order' => 'DESC',
						'category__in' => array(20, 11, 9, 12, 306, 305, 303, 304) /* 285, 53*/
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
					
						switch($count){
							case 0:
								
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'medium' );
								
								?>
								<div class="row">
									<div class="col-sm-12 col-md-6">
										<div class="insights-grid-content-featured">
											<?php if( !empty($image_url[0]) ){ ?>
											<a href="<?php echo get_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" /></a>
											<?php } ?>
											<a href="<?php echo get_permalink(); ?>"><?php echo the_title() ?></a>
										</div>
									</div>
								<?php
								break;
							case 1:
								
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'medium' );
								
								?>
									<div class="col-sm-12 col-md-6">
										<div class="insights-grid-content-featured">
											<?php if( !empty($image_url[0]) ){ ?>
											<a href="<?php echo get_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" /></a>
											<?php } ?>
											<a href="<?php echo get_permalink(); ?>"><?php echo the_title() ?></a>
										</div>
									</div>
								</div>
								<ul class="insights-grid-content-list">
								<?php
								break;
							default:
								?>
								<li>
									<a href="<?php echo get_permalink(); ?>"><?php echo the_title() ?></a>
								</li>
								<?
								break;
						}
				?>
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
			
<div class="insights-grid-speaking grey-background">
	<div class="container">
		<div class="insights-grid-speaking-title text-blue text-center row">
			<p class="heading">Past Speaking Presentations</p>
		</div>
		<div class="insights-grid-speaking-posts row">
			<?php
				
				$args = array(
					'post_type' => 'post', 
					'posts_per_page' => 3, 
					'orderby' => 'date', 
					'order' => 'DESC',
					'category__in' => 285
				);
					
				$count = 0;
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
				
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'medium' );
			?>
			<div class="insights-grid-speaking-post col-md-4">
				<a href="<?php echo get_permalink(); ?>" title="<?php echo the_title() ?>">
					<?php if( !empty( $image_url[0] ) ){ ?>
						<img src="<?php echo $image_url[0]; ?>" title="<?php echo the_title() ?>" />
					<?php }else{ ?>
						<p><?php echo the_title() ?></p>
					<?php } ?>
				</a>
			</div>
			<?php
				endwhile; 
				wp_reset_query();
			?>
		</div>
		<div class="row">
			<div class="col-md-3 col-md-offset-3">
				<a class="btn btn-primary" href="/speaker">Book A Speaker</a>
			</div>
			<div class="col-md-3">
				<a class="btn btn-secondary" href="/category/posts/presentations/">More Presentations</a>
			</div>
		</div>
	</div>
</div>
			



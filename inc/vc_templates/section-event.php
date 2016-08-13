	<div id="event-holder">
	<?php
				$args = array( 'post_type' => 'seminar', 'posts_per_page' => 1, 'orderby' => 'meta_value', 'meta_key' => 'event_date', 'order' => 'ASC', 
					'tax_query' => array(
						array(
							'taxonomy' => 'event-type',
							'field'    => 'term_id',
							'terms'    => array( 333, 334, 335 )
						),
					),
					'meta_query' => array(
						array('key' => 'registration_status', 'value' => 'closed', 'compare' => '!=')
					)
				);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
			?>
			<div class="col-sm-3 col-md-3 event-info">
				<div class="event-date">
					<span class="event-tag">SEMINAR</span>
					<?php echo date('M d', strtotime(get_field('event_date')) ); ?>
				</div>
			</div>
			<div class="col-sm-8 col-md-8 col-md-offset-1 event-details">
  				<h1><a href="<?php echo get_permalink(); ?>" data-postid="<?php echo get_the_id(); ?>"><?php echo the_title() ?></a></h1>
  				<p><?php echo the_excerpt() ?></p>
  				<ul>
  					<li><a href="/articles/seminar/">Full Event Schedule</a></li>
  					<li><a href="/articles/speakers">Book A Speaker or Trainer</a></li>
  				</ul>
  			</div>
  			<?php endwhile; ?>
  			
	</div>
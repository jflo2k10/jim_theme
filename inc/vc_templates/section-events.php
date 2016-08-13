<style>
	.timeline {
	  list-style: none;
	  padding: 20px 0 20px;
	  position: relative;
	}
	.timeline:before {
	  top: 0;
	  bottom: 0;
	  position: absolute;
	  content: " ";
	  width: 3px;
	  background-color: rgba(0, 156, 208, .2);
	  left: 50%;
	  margin-left: -1.5px;
	}
	.timeline > li {
	  margin: 50px 0;
	  position: relative;
	}
	.timeline > li:before,
	.timeline > li:after {
	  content: " ";
	  display: table;
	}
	.timeline > li:after {
	  clear: both;
	}
	.timeline > li:before,
	.timeline > li:after {
	  content: " ";
	  display: table;
	}
	.timeline > li:after {
	  clear: both;
	}
	.timeline > li > .timeline-panel {
		background: #fff;
		margin-top: 20px;
		width: 43%;
		float: left;
		border: 1px solid #d4d4d4;
		border-radius: 2px;
		padding: 20px;
		position: relative;
		-webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
		box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
	}
	.timeline > li > .timeline-panel .timeline-type {
		color: #787878;
		  text-transform: uppercase;
		  font-weight: 300;
		  letter-spacing: .09em;
	}
	.timeline > li > .timeline-panel a {
		font-size:1.6em;
	}
	.timeline > li > .timeline-panel:before {
	  position: absolute;
	  top: 26px;
	  right: -15px;
	  display: inline-block;
	  border-top: 15px solid transparent;
	  border-left: 15px solid #ccc;
	  border-right: 0 solid #ccc;
	  border-bottom: 15px solid transparent;
	  content: " ";
	}
	.timeline > li > .timeline-panel:after {
	  position: absolute;
	  top: 27px;
	  right: -14px;
	  display: inline-block;
	  border-top: 14px solid transparent;
	  border-left: 14px solid #fff;
	  border-right: 0 solid #fff;
	  border-bottom: 14px solid transparent;
	  content: " ";
	}
	.timeline > li > .timeline-badge {
	  	color: #fff;
		width: 100px;
		height: 100px;
		line-height: 1.3em;
		padding: 30px 20px 0;
		font-size: 1em;
		text-align: center;
		position: absolute;
		top: 16px;
		left: 50%;
		margin-left: -50px;
		background-color: #009cd0;
		z-index: 100;
		border-top-right-radius: 50%;
		border-top-left-radius: 50%;
		border-bottom-right-radius: 50%;
		border-bottom-left-radius: 50%;
	}
	.timeline > li.timeline-inverted > .timeline-panel {
	  float: right;
	}
	.timeline > li.timeline-inverted > .timeline-panel:before {
	  border-left-width: 0;
	  border-right-width: 15px;
	  left: -15px;
	  right: auto;
	}
	.timeline > li.timeline-inverted > .timeline-panel:after {
	  border-left-width: 0;
	  border-right-width: 14px;
	  left: -14px;
	  right: auto;
	}
	.seminar .timeline-badge {
	  background-color: #009cd0 !important;
	}
	.webinar .timeline-badge {
	  background-color: #7AC943 !important;
	}
	.bootcamp .timeline-badge {
	  background-color: #f15a24 !important;
	}
	.seminar .timeline-panel a {
		color: #009cd0 !important;
	}
	.webinar .timeline-panel a {
		color: #7AC943 !important;
	}
	.bootcamp .timeline-panel a {
		color: #f15a24 !important;
	}
	.timeline-title {
	  margin-top: 0;
	  color: inherit;
	}
	.timeline-body > p,
	.timeline-body > ul {
	  margin-bottom: 0;
	}
	.timeline-body > p + p {
	  margin-top: 5px;
	}
	.timeline-body p {
		font-size: 1.1em;
		line-height: 1.6em;
	}

	 ul.past-events { margin:40px 0 0 0; padding:0; list-style-type:none; }
	 ul.past-events li { height:250px; padding-right:10%; }
	 ul.past-events li a { font-size:1.6em; }
	 ul.past-events li p {  }
</style>

<section>

	<ul class="timeline">
		<?php
			$count = 0;
			$args = array( 
				'post_type' => 'seminar', 'posts_per_page' => 42, 'orderby' => 'meta_value', 'meta_key' => 'event_date', 'order' => 'ASC',
				'meta_query' => array(
					array('key' => 'registration_status', 'value' => 'closed', 'compare' => '!=')
				)
			);
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
			
				$terms = get_the_terms($post->ID, 'event-type');
				foreach ($terms as $taxindex => $taxitem) {
					
				}
				
				$li_class = ( ($count % 2) != 0 ) ? 'timeline-inverted' : '';
				
			?>
			<li class="<?php echo $li_class; ?> <?php echo $taxitem->slug; ?>">
				<div class="timeline-badge"><?php echo date('M d, Y', strtotime(get_field('event_date')) ); ?></div>
          		<div class="timeline-panel">
          			<div class="timeline-type">
          				<?php echo $taxitem->name ?>
          			</div>
					<a href="<?php echo get_permalink(); ?>" data-postid="<?php echo get_the_id(); ?>"><?php echo the_title() ?></a>
					<div class="timeline-body">
						<?php echo the_excerpt() ?>
					</div>
					<p><small class="text-muted">
						<?php echo date('M d, Y', strtotime(get_field('event_date')) ); ?> at <?php echo get_field('event_time'); ?>
					</small></p>
				</div>
			</li>
		<?php $count++; endwhile; ?>
	</ul>
		
		
	<?php
		$args = array( 
			'post_type' => 'seminar', 'posts_per_page' => 12, 'orderby' => 'menu_order', 'order' => 'ASC',
			'meta_query' => array(
				array('key' => 'registration_status', 'value' => 'open', 'compare' => '!=')
			)
		);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) :
	?>
	<div class="text-center">
		<h2>Past Events</h2>
		<h3 class="text-muted">Get the slides, read related articles and more</h3>
	</div>
		
	<ul class="past-events">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<li class="col-sm-6">
			<a href="<?php echo get_permalink(); ?>" data-postid="<?php echo get_the_id(); ?>"><?php echo the_title() ?></a>
			<small><?php echo the_excerpt() ?></small>
		</li>
	<?php endwhile; endif; ?>
	</ul>
	
	<div id="article-sharing">
		<script type="text/javascript">var switchTo5x=true;</script>
		<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher:'4f46efcc-9f9e-45b7-af09-9b8bb76f5a30'});</script>
        <span class='st_linkedin_vcount' displayText='LinkedIn'></span>
        <span class='st_twitter_vcount' displayText='Tweet'></span>
        <span class='st_facebook_vcount' displayText='Facebook'></span>
        <span class='st_plusone_vcount' ></span>
        <span class='st_email_vcount' displayText='Email'></span>
		<span class='st_sharethis_vcount' displayText='ShareThis'></span>
	</div>

</section>
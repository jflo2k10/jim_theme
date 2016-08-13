	<div class="latest-infographic">
	<div class="col-sm-6 col-md-5 col-lg-5">
	<?php
		$args = array( 'post_type' => 'infographics', 'posts_per_page' => 1, 'post_status' => 'publish', 'orderby' => 'rand',
			'meta_query' => array(
				array('key' => 'created_by_insivia', 'value' => '1', 'compare' => '==')
			)
		);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
	?>
		<h4><a href="<?php echo get_permalink(); ?>" data-postid="<?php echo get_the_id(); ?>"><?php echo the_title() ?></a></h4>
		<div class="latest-infographic-excerpt"><?php echo the_excerpt() ?></div>
		<?php endwhile; ?>
		<ul class="infographic-actions">
			<li>
				<div class="infographic-actions-title">Thousands of <strong>articles, videos, tips &amp; infographics</strong> by the insivia team.</div>
				<a href="/articles">Check Out Our Insights</a>
			</li>
		</ul>
	</div>
	<div class="col-sm-6 col-md-6 col-md-offset-1 col-lg-offset-1">
		<div class="latest-infographic-img-holder">
			<a href="<?php echo get_permalink(); ?>" data-postid="<?php echo get_the_id(); ?>"><img class="latest-infographic-img" src="<?php $infographic = get_field('infographic'); echo $infographic['url']; ?>" /></a>
		</div>
	</div>
	</div>
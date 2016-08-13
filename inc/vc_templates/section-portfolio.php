<section id="content">

	<div id="portfolio" class="layout">
		<div id="portfolio-sort-title">
		
			<div id="filter">filter <span>(<a href="javascript:void(0);">see full list</a>)</span></div>
			<span id="catcount"></span>
			
		</div>
	
		<div id="portfolio-sort">
			<ul class="sort-sentence"></ul>
			<div class="controls">
				<a id="go-prev" href="javascript:void(0);">PREV</a>&nbsp; &nbsp;<a id="go-next" href="javascript:void(0);">NEXT</a>
			</div>
		</div>
			
		<div id="portfolio-list">
			<ul>
			<?php
			$args = array( 'post_type' => 'portfolio_item', 'posts_per_page' => 9999, 'orderby' => 'menu_order', 'order' => 'ASC' );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
			?>
			<li title="<?php echo get_the_title(); ?>"><a pid="<?php echo get_the_id(); ?>" href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
			<?php
			endwhile;
			?>
			</ul>
		</div>
			
		<div id="portfolio-item">
			<div class="portfolio-item-header">
				<h2></h2>
				<div id="altopts"></div>
			</div>
			<div id="client-visual"></div>
		</div>
		
	</div>
	
</section>
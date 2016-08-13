<?php

	$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full',false);
	if( isset($featured_image[0]) ){
		$bg_style = ' style="background-image:url(' . $featured_image[0] . ');"';
	}else{
		$bg_style = '';
	}

?>
<div id="banner-section" class="blue-background text-white text-center">
	<div class="container">
		
		<?php if ( 'seminar' == get_post_type() ){ ?>
			<h1 class="text-shadow entry-title"><?php the_title(); ?></h1>
			<p class="banner-section-date">On <?php echo date('F j, Y', strtotime( get_field('event_date') )); ?> at <?php echo get_field('event_time'); ?></p>
		
			<div id="article-sharing" class="header-article-sharing">
				<span class='st_sharethis_hcount' displayText='ShareThis'></span>
				<span class='st_facebook_hcount' displayText='Facebook'></span>
				<span class='st_twitter_hcount' displayText='Tweet'></span>
				<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
				<span class='st_googleplus_hcount' displayText='Google +'></span>
			</div>
			
		<?php } else if ( 'software' == get_post_type() ){ ?>
		
			<h1 class="text-shadow entry-title"><?php the_title(); ?></h1>
			<p class="banner-section-date "><?php echo the_field('short_description'); ?></p>
			
		<?php } else if( is_category() || is_tag() || is_archive() ){ ?>
			
			<h1 class="entry-title"><?php echo single_cat_title( '', false ); ?> Insights</h1>
			
		<?php }else{ ?>
			
			<h1 class="text-shadow entry-title"><?php the_title(); ?></h1>
			<p class="banner-section-date updated"><?php the_date( 'F j, Y' ); ?></p>
			
			<div id="article-sharing" class="header-article-sharing">
				<span class='st_sharethis_hcount' displayText='ShareThis'></span>
				<span class='st_facebook_hcount' displayText='Facebook'></span>
				<span class='st_twitter_hcount' displayText='Tweet'></span>
				<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
				<span class='st_googleplus_hcount' displayText='Google +'></span>
			</div>
			
		<?php } ?>
		
	</div>
</div>
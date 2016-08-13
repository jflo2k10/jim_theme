<?php

	extract( shortcode_atts( array(
    	'page' => 'home'
	), $atts ) );

	switch( $atts['page'] ){
		case 'company':
			$banner = array(
				'poster' => '/wp-content/media/videos/banner2.jpg',
				'mp4' => '/wp-content/media/videos/banner2.mp4',
				'webm' => '/wp-content/media/videos/banner2.webm',
				'ogv' => '/wp-content/media/videos/banner2.ogv',
			);
			break;
			
		case 'services':
			$banner = array(
				'poster' => '/wp-content/media/videos/services.jpg',
				'mp4' => '/wp-content/media/videos/services.mp4',
				'webm' => '/wp-content/media/videos/services.webm',
				'ogv' => '/wp-content/media/videos/services.ogv',
			);
			break;
			
		case 'insights':
			$banner = array(
				'poster' => '/wp-content/media/images/andy_seminar.jpg',
				'mp4' => '/wp-content/media/videos/andy_seminar.mp4',
				'webm' => '/wp-content/media/videos/andy_seminar.webm',
				'ogv' => '/wp-content/media/videos/andy_seminar.ogv',
			);
			break;
		
		default:
			$banners = array(
				0 => array(
					'poster' => '/wp-content/media/videos/banner2.jpg',
					'mp4' => '/wp-content/media/videos/banner3.mp4',
					'webm' => '/wp-content/media/videos/banner3.webm',
					'ogv' => '/wp-content/media/videos/banner3.ogv',
				),
				1 => array(
					'poster' => '/wp-content/media/videos/banner2.jpg',
					'mp4' => '/wp-content/media/videos/banner2.mp4',
					'webm' => '/wp-content/media/videos/banner2.webm',
					'ogv' => '/wp-content/media/videos/banner2.ogv',
				),
			);
			$temp = array_rand($banners);
			$banner = $banners[$temp];
			break;
	}

?>
<div id="video-banner" class="video-banner-<?php echo $atts['page']; ?>">
	<div id="video-text"><?php echo wpb_js_remove_wpautop($content, true); ?></div>
	<video preload="auto" poster="<?php echo $banner['poster']; ?>" autoplay="autoplay" loop="loop" muted="true" width="100%">
		<source src="<?php echo $banner['mp4']; ?>" type="video/mp4">
		<source src="<?php echo $banner['webm']; ?>" type="video/webm">
		<source src="<?php echo $banner['ogv']; ?>" type="video/ogg">
		<!-- Flash fallback -->
	  	<object width="100%" type="application/x-shockwave-flash" data="/wp-content/themes/insivia/media/flash/StrobeMediaPlayback.swf">
			<param name="movie" value="/wp-content/themes/insivia/media/flash/StrobeMediaPlayback.swf">
			<param name="flashvars" value="src=<?php echo $banner['mp4']; ?>&amp;poster=<?php echo $banner['poster']; ?>&amp;streamType=recorded&amp;loop=true&amp;autoPlay=true&amp;mute=true&amp;playButtonOverlay=false&amp;controlBarAutoHide=true&amp;mute=true">
			<param name="wmode" value="transparent">
		</object>
		<!-- image fallback -->
		<img id="mobile-photo-banner" src="<?php echo $banner['poster']; ?>">
	</video>
</div>
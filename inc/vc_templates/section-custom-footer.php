<?php

	extract( shortcode_atts( array(
    	'headline' => '',
    	'subline' => ''
	), $atts ) );

?>
<div class="footer-holder">
	<div class="footer-frame">
		<section id="footer-form" class="container">

			<?php 
				if( empty($atts['headline']) ){
					?>
					<h1>Get in Touch</h1>
					<h2 data-placeholder="Have a project, question, or just want to say hi?">Have a project, question, or just want to say hi?</h2>
					<?
				}else{
					?>
					<h1><?php echo $atts['headline']; ?></h1>
					<h2 data-placeholder="<?php echo $atts['subline']; ?>"><?php echo $atts['subline']; ?></h2>
					<?
				}
			?>
			
					
			<?php 
				gravity_form(4, false, false, true, null, true);
				wp_dequeue_style('gforms_css');
			?>
			
					<div class="shadow-container">
						<article class="info-box">
							<div class="text-holder">
								<p>Founded in 2002, Insivia provides <a href="/about/digital/research-strategic-planning/">smart strategies</a>, <a href="/about/digital/website-design-landing-pages/">killer websites</a>, <a href="/about/digital/website-interactive/">innovative interactive</a> & <a href="/about/digital/mobile-web-apps/">powerful software</a> that get results for a wide variety of organizations. We are a team of extremely <a href="/about/">dedicated, skilled people</a> who love our clients and producing <a href="/portfolio/">the best work</a> each and every time.</p>
							</div>
							<address class="address vcard">
								<strong class="fn org hidden">Insivia</strong>
								<span class="adr"><span class="type hidden">work</span>
								<span class="street-address">5000 Euclid Ave., Suite 102</span>
								<span class="locality">Cleveland</span>, <abbr class="region" title="Ohio">OH</abbr> <span class="postal-code">44103</span></span><br/>
								<span class="tel"><span class="type hidden">work</span><span class="value">216-373-1080</span></span>
								<span class="email-holder"><a class="email" href="mailto:&#115;&#097;&#121;&#104;&#101;&#108;&#108;&#111;&#064;&#105;&#110;&#115;&#105;&#118;&#105;&#097;&#046;&#099;&#111;&#109;">&#115;&#097;&#121;&#104;&#101;&#108;&#108;&#111;&#064;&#105;&#110;&#115;&#105;&#118;&#105;&#097;&#046;&#099;&#111;&#109;</a></span>
								<a class="url hidden" href="http://insivia.com">insivia.com</a>
							</address>
						</article>
						<div class="footer-nav text-white">
							We're looking to add awesome people to our team. <a href="/contact#careers">Check out our openings</a>.
							<?php //wp_nav_menu( array('menu' => 'Footer Menu','items_wrap' => '<ul>%3$s</ul>','container'=>'', ) ); ?>
						</div>
					</div>
					
		</section>
	</div>
</div>

<div class="copyright">
	<p>all rights reserved. <?php echo date('Y'); ?> insivia, a strategic marketing agency.</p>
</div>
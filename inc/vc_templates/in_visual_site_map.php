<?php

extract(shortcode_atts(array(
    'title' => 'Site Map'
), $atts));

ob_start();
?>
<style>
/* ------------------------------------------------------------
	NUMBER OF COLUMNS: Adjust #primaryNav li to set the number
	of columns required in your site map. The default is 
	4 columns (25%). 5 columns would be 20%, 6 columns would 
	be 16.6%, etc. 
------------------------------------------------------------ */

#primaryNav li { width:25%; }
  #primaryNav li ul li { width:100% !important; }

#primaryNav.col1 li { width:99.9%; }
#primaryNav.col2 li { width:50.0%; }
#primaryNav.col3 li { width:33.3%; }
#primaryNav.col4 li { width:25.0%; }
#primaryNav.col5 li { width:20.0%; }
#primaryNav.col6 li { width:16.6%; }
#primaryNav.col7 li { width:14.2%; }
#primaryNav.col8 li { width:12.5%; }
#primaryNav.col9 li { width:11.1%; }
#primaryNav.col10 li { width:10.0%; }

/* ------------------------------------------------------------
	General Styles
------------------------------------------------------------ */

body {
	background: white;
	color: black;
	font-family: Gotham, Helvetica, Arial, sans-serif;
	font-size: 12px;
	line-height: 1;
}
  body.home { padding:40px; }
  .sitemap { margin: 0 0 40px 0; float: left; width: 100%; }
    h1 {
    	font-weight: bold;
    	text-transform: uppercase;
    	font-size: 20px;
    	margin: 0 0 5px 0;
    }
    h2 {
    	font-family: "Lucida Grande", Verdana, sans-serif;
    	font-size: 10px;
    	color: #777777;
    	margin: 0 0 20px 0;
    }
    a { text-decoration: none; }
    ol,
    ul { list-style: none; }


/* ------------------------------------------------------------
	Site Map Styles
------------------------------------------------------------ */

/* --------	Top Level --------- */

#primaryNav { margin: 0; float: left; width: 100%; }
  #primaryNav #home {
  	display: block;
  	float: none;
  	background: #ffffff url('images/L1-left.png') center bottom no-repeat;
  	position: relative;
  	z-index: 2;
  	padding: 0 0 30px 0;
  }
    #primaryNav li {
    	float: left;
    	background: url('images/L1-center.png') center top no-repeat;
    	padding: 30px 0;
    	margin-top: -30px;
    }
      #primaryNav li a {
      	margin: 0 20px 0 0;
      	padding: 10px 0;
      	display: block;
      	font-size: 14px;
      	font-weight: bold;
      	text-align: center;
      	color: black;	
      	background: #c3eafb url('images/white-highlight.png') top left repeat-x;
      	border: 2px solid #b5d9ea;
      	-moz-border-radius: 5px;
      	-webkit-border-radius: 5px;
      	-webkit-box-shadow: rgba(0,0,0,0.5) 2px 2px 2px; 
      	-moz-box-shadow: rgba(0,0,0,0.5) 2px 2px 2px; /* FF 3.5+ */	
      }
        #primaryNav li a:hover { background-color: #e2f4fd; border-color: #97bdcf; }
  #primaryNav li:last-child { background: url('images/L1-right.png') center top no-repeat; }
  #primaryNav li a:link:before,
  #primaryNav li a:visited:before { color: #78a9c0; }

/* --------	Second Level --------- */

#primaryNav li li {
	width: 100%;
	clear: left;
	margin-top: 0;
	padding: 10px 0 0 0;
	background: url('images/vertical-line.png') center bottom repeat-y;
}
  #primaryNav li li a { background-color: #cee3ac; border-color: #b8da83; }
    #primaryNav li li a:hover { border-color: #94b75f; background-color: #e7f1d7; }
  #primaryNav li li:first-child { padding-top: 30px; }
  #primaryNav li li:last-child { background: url('images/vertical-line.png') center bottom repeat-y; }
  #primaryNav li li a:link:before,
  #primaryNav li li a:visited:before { color: #8faf5c; }

/* --------	Third Level --------- */

#primaryNav li li ul {
	margin: 10px 0 0 0;
	width: 100%;
	float: right;
	padding: 9px 0 10px 0;
	background: #ffffff url('images/L3-ul-top.png') center top no-repeat;
}
  #primaryNav li li li { background: url('images/L3-center.png') left center no-repeat; padding: 5px 0; }
    #primaryNav li li li a {
    	background-color: #fff7aa;
    	border-color: #e3ca4b;
    	font-size: 12px;
    	padding: 5px 0;
    	width: 80%;
    	float: right;
    }
    #primaryNav li li li a:hover { background-color: #fffce5; border-color: #d1b62c; }
  #primaryNav li li li:first-child { padding: 15px 0 5px 0; background: url('images/L3-li-top.png') left center no-repeat; }
  #primaryNav li li li:last-child { background: url('images/L3-bottom.png') left center no-repeat; }
    #primaryNav li li li a:link:before,
    #primaryNav li li li a:visited:before { color: #ccae14; font-size: 9px; }


/* ------------------------------------------------------------
	Utility Navigation
------------------------------------------------------------ */

#utilityNav { float: right; max-width: 50%; margin-right: 10px; }
  #utilityNav li { float: left; margin-bottom: 10px; }
    #utilityNav li a {
    	margin: 0 10px 0 0;
    	padding: 5px 10px;
    	display: block;	
    	border: 2px solid #e3ca4b;
    	font-size: 12px;
    	font-weight: bold;
    	text-align: center;
    	color: black;
    	background: #fff7aa url('images/white-highlight.png') top left repeat-x;
    	-moz-border-radius: 5px;
    	-webkit-border-radius: 5px;
    	-webkit-box-shadow: rgba(0,0,0,0.5) 2px 2px 2px; 
    	-moz-box-shadow: rgba(0,0,0,0.5) 2px 2px 2px; /* FF 3.5+ */	
    }
      #utilityNav li a:hover { background-color: #fffce5; border-color: #d1b62c; }
      #utilityNav li a:link:before,
      #utilityNav li a:visited:before { color: #ccae14; font-size: 9px; margin-bottom: 3px; }
</style>

<?php
	if ( has_nav_menu( 'utility-nav' ) ) : ?>
			<?php wp_nav_menu( array(
				'theme_location' => 'utility-nav', 
				'container' => 'nav', 
				'container_id' => 'utility-nav', 
				'menu_id' => 'utilityNav', 
				'sort_column' => 'menu_order'
				));
			?>
  	<?php else : ?>
  			<nav id="utility-nav">
				<ul id="utilityNav">
					<li><!-- maybe put somethign else here --></li>
				</ul>
			</nav>
	<?php endif; ?>
	
	<?php 
	
	if ( has_nav_menu( 'primary-nav' ) ) :
		
		wp_nav_menu( 
  	  		array(
	  	  	'theme_location' => 'primary-nav', 
	  	  	'container' => 'nav', 
	  	  	'container_id' => 'primary-nav', 
	  	  	'container_class' => 'custom-menu', 
	  	  	'menu_id' => 'primaryNav', 
	  	  	'sort_column' => 'menu_order'
			)
		);
		
	else : ?>
	
  	<nav id="primary-nav">
		<ul id="primaryNav" class="col<?php echo get_option(THEME_PREFIX . "columns"); ?>">
			<li id="home">
				<?php $page = get_page_by_title('Home'); ?>
				<a href="<?php echo get_permalink( $page->ID ); ?>">Home</a>
			</li>
		    <?php wp_list_pages('title_li='); ?>
		</ul>
	</nav>
	
	<?php endif;
return ob_get_clean();
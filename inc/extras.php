<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Insivia_Base
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
//Slugify
if(!function_exists('slugify')) {
  function slugify($text) {
  	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  	$text = trim($text, '-');
  	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  	$text = strtolower($text);
  	$text = preg_replace('~[^-\w]+~', '', $text);
  
  	if (empty($text)) {
  		return 'n-a';
  	}
  
  	return $text;
  }
}

//Browser Detection http://php.net/manual/en/function.get-browser.php courtesy of ruudrp at live dot nl ¶
function getBrowser() { 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";
    $mobile = "desktop";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    if(preg_match('/Mobile/i',$u_agent)) { $mobile = "mobile"; }
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'   => $pattern,
        'mobile'    => $mobile
    );
} 

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function insivia_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

  $ua=getBrowser();
	
	if($ua['name']) {
  	
  	if($ua['name'] == 'Unknown') {
    	$ua['name'] = 'Internet Explorer';
  	}
  	
  	$classes[] = slugify($ua['name']);
	}
	
	if($ua['version']) {
  	$version = $ua['version'];
    if (strpos($version, '.') !== false) {
        
        $classes[] = 'version-'.floor($version);
        
    } else {
      $classes[] = 'version-'.$version;
    }
	}
	
	if($ua['mobile']) {
  	$classes[] = slugify($ua['mobile']);
	}
    
	return $classes;
}
add_filter( 'body_class', 'insivia_body_classes' );

/**
 * Adds a 'Client' user role
 * https://codex.wordpress.org/Roles_and_Capabilities
 */

add_action('init', 'add_client_role');

function add_client_role() {
	global $wp_roles;
	if ( ! isset( $wp_roles ) )
		$wp_roles = new WP_Roles();

	$adm = $wp_roles->get_role('administrator');
	//Adding a 'new_role' with all admin caps
	$wp_roles->add_role('client', 'Client', $adm->capabilities);
}

add_action('init', 'revoke_client_capabilities', 10);

function revoke_client_capabilities() {
	$caps_to_remove = array(
		'update_core',
		'activate_plugins',
		'install_plugins',
		'update_plugin',
		'edit_plugins',
		'edit_themes',
		'export',
		'import',
		'create_users',
		'manage_options',
		'switch_themes' // etc
	);
	$custom_role = get_role('client'); // Edit according to your role as it was declared when added
	foreach($caps_to_remove as $cap) {
		$custom_role->remove_cap($cap);     
	}
}

/**
 * Hide Advanced Custom Fields from non-admins
 */

add_filter('acf/settings/show_admin', 'my_acf_show_admin');

function my_acf_show_admin( $show ) {
	
	return current_user_can('manage_options');
	
}

/**
 * Adds a custom Dashboard Widget
 */
function dashboard_widget_function() {
	 $rss = fetch_feed( "http://www.insivia.com/feed/" );
  
	 if ( is_wp_error($rss) ) {
		  if ( is_admin() || current_user_can('manage_options') ) {
			   echo '<p>';
			   printf(__('<strong>RSS Error</strong>: %s', 'insivia'), $rss->get_error_message());
			   echo '</p>';
		  }
	 return;
}
  
if ( !$rss->get_item_quantity() ) {
	 echo '<p>Apparently, there are no updates to show!</p>';
	 $rss->__destruct();
	 unset($rss);
	 return;
}
  
echo "<ul>\n";
  
if ( !isset($items) )
	 $items = 4;
  
	 foreach ( $rss->get_items(0, $items) as $item ) {
		  $publisher = '';
		  $site_link = '';
		  $link = '';
		  $content = '';
		  $date = '';
		  $link = esc_url( strip_tags( $item->get_link() ) );
		  $title = esc_html( $item->get_title() );
		  $content = $item->get_content();
		  $content = wp_html_excerpt($content, 140) . ' ...';
  
		 echo "<li><a class='rsswidget' href='$link'>$title</a>\n<div class='rssSummary'>$content</div>\n";
}
  
echo "</ul>\n";
echo "<hr><a href='http://www.insivia.com/contact/'>Need Help? Contact Insivia</a>";
$rss->__destruct();
unset($rss);
}
 
function add_dashboard_widget() {
	 wp_add_dashboard_widget('insivia_dashboard_widget', 'Latest from Insivia', 'dashboard_widget_function');
}
 
add_action('wp_dashboard_setup', 'add_dashboard_widget');

//http://callmenick.com/post/custom-wordpress-loop-with-pagination
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;', 'insivia'),
    'next_text'       => __('&raquo;', 'insivia'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      //echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}


//https://codex.wordpress.org/Class_Reference/WP_Post
function custom_query($post_type = array( 'post' ), $post_status = array( 'publish' ), $category_name = '', $taxonomy = '', $term = '', $order = 'DESC', $orderby = 'date', $posts_per_page = 10) {
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

	// WP_Query arguments
	$args = array (
		'post_type'              => $post_type,
		'post_status'            => $post_status,
		'category_name'          => $category_name,
		'pagination'             => true,
		'posts_per_page'         => $posts_per_page,
		'ignore_sticky_posts'    => true,
		'order'                  => $order,
		'orderby'                => $orderby,
		'paged'                  => $paged,
	);
	
	if($taxonomy&&$category_name) {
  	$args = array (
  		'post_type'              => $post_type,
  		'post_status'            => $post_status,
      'tax_query' => array(
        'relation'             => 'AND',
      		array(
      			'taxonomy'         => 'category',
      			'field'            => 'slug',
      			'terms'            => array($category_name),
      		),
      		array(
      			'taxonomy'         => $taxonomy,
      			'field'            => 'slug',
      			'terms'            => array($term),
      		),
      	),
  		'pagination'             => true,
  		'posts_per_page'         => $posts_per_page,
  		'ignore_sticky_posts'    => true,
  		'order'                  => $order,
  		'orderby'                => $orderby,
  	);
	}
	
	if($taxonomy&&!$category_name) {
  	$args = array (
  		'post_type'              => $post_type,
  		'post_status'            => $post_status,
      'tax_query' => array(
        'relation'             => 'OR',
      		array(
      			'taxonomy'         => 'category',
      			'field'            => 'slug',
      			'terms'            => array($category_name),
      		),
      		array(
      			'taxonomy'         => $taxonomy,
      			'field'            => 'slug',
      			'terms'            => array($term),
      		),
      	),
  		'pagination'             => true,
  		'posts_per_page'         => $posts_per_page,
  		'ignore_sticky_posts'    => true,
  		'order'                  => $order,
  		'orderby'                => $orderby,
  	);
	}
	

	// The Query
	$query = new WP_Query( $args );
  
  return $query;
  
	//return $query->get_posts();

/* //Usage
			$query = custom_query();

			foreach($query as $q) :
				echo $q->post_name;
			endforeach;
*/

}

//https://codex.wordpress.org/Class_Reference/WP_User_Query#Return_Fields_Parameter
function user_query($role = array('Administrator') , $number = '10', $order = 'ASC', $orderby = 'user_name', $count_total = true, $fields = 'all') {

	// WP_User_Query arguments
	$args = array (
		'role'           => $role,
		'number'         => $number,
		'order'          => $order,
		'orderby'        => $orderby,
		'count_total'    => $count_total,
		'fields'         => $fields,
	);

	// The User Query
	$users = new WP_User_Query( $args );

	return $users->results;

	/* //Usage
	$users = user_query();
	if ( ! empty( $users) ) {
		foreach ( $users as $user ) {
			echo $user->display_name;
		}
	} else {
		// no users found
	}*/

}

//Copyright
function auto_copyright($year = 'auto'){
  if(intval($year) == 'auto'){ $year = date('Y'); }
  if(intval($year) == date('Y')){ echo intval($year); }
  if(intval($year) < date('Y')){ echo intval($year) . ' - ' . date('Y'); }
  if(intval($year) > date('Y')){ echo date('Y'); }
}

//Custom Excerpt More
function new_excerpt_more( $more ) {
  global $post;
	return '&hellip; <br/><a href="'.get_permalink($post->ID).'">Read more &#187;</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

//Determine Page Slug for ID
function set_slug_for_id() {
  global $post;

  if($post) {
    if(is_search()) {
      $slug = 'search-result';
    } elseif(is_archive()) {
      $slug = get_post_type($post).'-archive';
    } elseif(is_front_page() && is_home()) {
      $slug = 'blog';
    } else {
      $slug = $post->post_name;
    }
  } else {
    if(is_404()) {
      $slug = 'error-404';
    } elseif(is_archive()) {
      $slug = 'archive';
    } elseif(is_front_page() && is_home()) {
      $slug = 'blog';
    } elseif(is_search()) {
      $slug = 'search-no-result';
    } else {
      $slug = wp_get_theme()->get('TextDomain');
    }
  }

  return $slug;
}

//Trim by word
function trunc($phrase, $max_words) {
   $phrase_array = explode(' ',$phrase);
   if(count($phrase_array) > $max_words && $max_words > 0)
      $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
   return $phrase;
}

//favicon handle
function add_favicon() {
	$favicon_url = get_template_directory_uri() . "/images/favicon.png";
	if( isset($insivia_config['dt-favicon-image']) && '' !== $insivia_config['dt-favicon-image']['url'] ){
		$favicon_url = $insivia_config['dt-favicon-image']['url'];
	}
	print "<link rel=\"shortcut icon\" type=\"image/png\" href=\"".$favicon_url."\">\n";

} 
add_action('wp_head', 'add_favicon');

function wp_trim_chars($text, $num_char = 55, $more = null){

  if ( null === $more )
    $more = '';
  $original_text = $text;
  $text = wp_strip_all_tags( $text );

  $words_array = preg_split( "/[\n\r\t ]+/", $text, $num_char + 1, PREG_SPLIT_NO_EMPTY );
  $text = @implode( ' ', $words_array );
  
  if ( strlen( $text ) > $num_char ) {
    $text = substr($text,0, $num_char );
    $text = $text . $more;
  }

  return apply_filters( 'wp_trim_chars', $text, $num_char, $more, $original_text );
}

//Change Hex Value to RGB
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; // returns an array with the rgb values
}

//make video responsive
function responsiveVideo($html, $data, $url) {
  $html = add_video_wmode_transparent($html);
  if (!is_admin() && !preg_match("/flex\-video/mi", $html) /*&& preg_match("/youtube|vimeo/", $url)*/) {
    $html="<div class=\"flex-video widescreen\">".$html."</div>";
  }
  return $html;
}
add_filter('embed_handler_html', 'responsiveVideo', 92, 3 ); 
add_filter('oembed_dataparse', 'responsiveVideo', 90, 3 );
add_filter('embed_oembed_html', 'responsiveVideo', 91, 3 );


function add_video_wmode_transparent($html) {
   if (strpos($html, "<iframe " ) !== false) {
      $search = array('?feature=oembed');
      $replace = array('?feature=oembed&wmode=transparent&rel=0&autohide=1&showinfo=0');
      $html = str_replace($search, $replace, $html);
      return $html;
   } else {
      return $html;
   }
}
add_filter('the_content', 'add_video_wmode_transparent', 10, 1);

//Remove shortcodes from content
function remove_shortcode_from_content($content) {
    // remove shortcodes
    $content = strip_shortcodes( $content );
    // remove images
    $content = preg_replace('/<img[^>]+./','', $content);
  return $content;
}

// Remove video from content              
function removeVideo($html, $data, $url) {
  return '';
}

// Remove first audio shortcode from content
function remove_first_audio_shortcode_from_content($content) {
  //Find audio shotcode in content
  $pattern = get_shortcode_regex();
  preg_match_all( '/'. $pattern .'/s', $content, $matches );

  /* find first audio shortcode */
  $i = 0;
  $hasaudioshortcode = false;
  foreach ($matches[2] as $shortcodetype) {
    if ($shortcodetype=='audio') {
      $hasaudioshortcode = true;
      break;
    }
      $i++;
  }
  if ($hasaudioshortcode) { $content = str_replace($matches[0][$i],'',$content); }

  return $content;
}

// Remove Gallery shortcode
function remove_first_gallery_shortcode_from_content($content) {
  //Find audio shotcode in content
  $pattern = get_shortcode_regex();
  preg_match_all( '/'. $pattern .'/s', $content, $matches );

  /* find first audio shortcode */
  $i = 0;
  $hasgalleryshortcode = false;
  foreach ($matches[2] as $shortcodetype) {
    if ($shortcodetype=='gallery') {
      $hasgalleryshortcode = true;
      break;
    }
      $i++;
  }
  if ($hasgalleryshortcode) { $content = str_replace($matches[0][$i],'',$content); }

  return $content;
}

function remove_first_image_from_content($content) {
    global $post;

    /* Get Image from featured image */
    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full',false); 
    if (isset($featured_image[0])) {
      //if image is featured image, it's not necessary to remove image from content
      return $content;
    } else {
      $imageurl1 = "";
      $imageurl2 = "";

      $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
      if ($output>0) {
        $imageurl1 = $matches[1][0];
      }

      /* Get Image from content image that has caption shortcode */
      $pattern = get_shortcode_regex();
      preg_match_all( '/'. $pattern .'/s', $content, $matches );
      /* find first caption shortcode */
      $i = 0;
      $hascaption = false;
      foreach ($matches[2] as $shortcodetype) {
        if ($shortcodetype=='caption') {
          $hascaption = true;
          break;
        }
          $i++;
      }

      if ($hascaption) {
        preg_match('/^<a.*?href=(["\'])(.*?)\1.*$/', $matches[5][$i], $m);
        preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $m[0], $m2);
        $imageurl2 = $m2[1][0];
      }

      if ($imageurl1==$imageurl2) {
        //if image in caption tag
        $content = str_replace($matches[0][$i],'',$content);
      } else {
        //if image not in caption tag
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        if ($output>0) {
          $content = str_replace($matches[0][0],'',$content);
        }
      }

      return $content;

    }
}

function remove_first_video_shortcode_from_content($content) {
  $hasvideoshortcode = false;
  //Find video shotcode in content
  $pattern = get_shortcode_regex();
  $found = preg_match_all( '/'. $pattern .'/s', $content, $matches );

  // find first video shortcode
  $i = 0;
  if ($found>0) {
    foreach ($matches[2] as $shortcodetype) {
      if ($shortcodetype=='video') {
        $hasvideoshortcode = true;
        break;
      }
        $i++;
    }
  }

  if ($hasvideoshortcode) { $content = str_replace($matches[0][0],'',$content); }

  return $content;
}

function removeFirstURLVideo($html, $data, $url, $post_id) {
  global $post;
  $found = preg_match('@https?://(www.)?(youtube|vimeo)\.com/(watch\?v=)?([a-zA-Z0-9_-]+)@im', $post->post_content, $urls);
  $youtubelink = '';
  if ($found>0) {
    if (isset($urls[0])) {
      $youtubelink = $urls[0];
    } //if isset($urls[0])
  }
  if ($data==$youtubelink) {
    return '';
  } else {
    return $html;
  }
}

function get_first_image_url_from_content() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  if (isset($post->post_content)) {
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (isset($matches[1][0])) {
      $first_img = $matches[1][0];
    }
  }
  return $first_img;
}
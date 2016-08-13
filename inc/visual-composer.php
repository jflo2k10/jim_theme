<?php
  if( function_exists('vc_set_as_theme') ){
    //Remove teaser grid
  	function remove_meta_box_vc(){
  	    remove_meta_box( 'vc_teaser','page','side');
  	}
  	add_action('admin_init','remove_meta_box_vc');
  }
  
  // Visual Site Map Functions
  function visual_site_map_func($atts) {
    return include( get_template_directory() . '/inc/vc_templates/in_visual_site_map.php' );
  }
  add_shortcode('visual_site_map', 'visual_site_map_func');
  
  // Video Banner Functions
  function insivia_video_banner_func( $atts, $content = null ) {
  	ob_start();
  	include( get_template_directory() . '/inc/vc_templates/section-video-banner.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'insivia_video_banner', 'insivia_video_banner_func' );
  
  // Infographic Functions
  function insivia_infographic_func( $atts ) {
  	ob_start();
  	include( get_template_directory() . '/inc/vc_templates/section-insight.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'insivia_infographic', 'insivia_infographic_func' );
  
  // Event Functions
  function insivia_event_func( $atts ) {
      ob_start();
  	include( get_template_directory() . '/inc/vc_templates/section-event.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'insivia_event', 'insivia_event_func' );
  
  // Social Functions
  function insivia_social_func( $atts ) {	
  	ob_start();
  	include( get_template_directory() . '/inc/vc_templates/section-socialbar.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'insivia_social', 'insivia_social_func' );
  
  // Standard Footer Functions
  function insivia_standard_footer_func( $atts ) {	
  	ob_start();
  	include( get_template_directory() . '/inc/vc_templates/section-footer.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'insivia_standard_footer', 'insivia_standard_footer_func' );
  
  // Insight Grid Functions
  function insivia_insight_grid_func( $atts ) {  	
  	wp_enqueue_script( 'jquery_isotope' , '/wp-content/themes/insivia2015_child_theme/js/plugins/jquery.isotope.min.js', array( ), '', true );
  	wp_enqueue_script( 'insivia_insight_grid' , '/wp-content/themes/insivia2015_child_theme/js/section-insight-grid.js', array('jquery_isotope'), '', true );
  	ob_start();
  	include( get_template_directory() . '/inc/vc_templates/section-insight-grid.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'insivia_insight_grid', 'insivia_insight_grid_func' );
  
  // Insight Header Functions
  function insivia_insight_header_func( $atts ) {
  	ob_start();
  	include( get_template_directory() . '/inc/vc_templates/section-insight-header.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'insivia_insight_header', 'insivia_insight_header_func' );
  
  // Portfolio Functions
  function insivia_portfolio_func( $atts ) {
  	ob_start();
  	wp_enqueue_script( 'insivia_portfolio' , '/wp-content/themes/insivia2015_child_theme/js/section-portfolio.js', array(), '', true );  	
  	include( get_template_directory() . '/inc/vc_templates/section-portfolio.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'insivia_portfolio', 'insivia_portfolio_func' );
  
  // Events Functions
  function insivia_events_func( $atts ) {
  	ob_start();
  	include( get_template_directory() . '/inc/vc_templates/section-events.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'insivia_events_list', 'insivia_events_func' );
  
  // Budget Calculator Functions
  function insivia_budget_calc_func( $atts ) {
  	ob_start();
  	include( get_template_directory() . '/inc/vc_templates/section-budget-calc.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'insivia_budget_calc', 'insivia_budget_calc_func' );
  
  // Software Library Functions
  function software_library_func( $atts ) {
  	ob_start();
  	include( get_template_directory() . '/inc/vc_templates/section-softwares.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'software_library', 'software_library_func' );
  
  // Innovations Functions
  function innovations_section_func( $atts ) {
  	ob_start();
  	include( get_template_directory() . '/inc/vc_templates/section-innovations.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'innovations_section', 'innovations_section_func' );
  
  // Custom Footer Functions
  function custom_footer_section_func( $atts ) {
  	ob_start();
  	include( get_template_directory() . '/inc/vc_templates/section-custom-footer.php' );
  	return ob_get_clean();
  }
  add_shortcode( 'custom_footer_section', 'custom_footer_section_func' );
  
  //Tie Custom Visual Composer functions into Visual Composer
  function custom_integrateWithVC() {
     vc_map( array(
        "name" => __( "Visual Site Map", "insivia" ),
        "base" => "visual_site_map",
        "class" => "",
        "category" => __( "Content", "insivia"),
     ));
    vc_map( array(
    	"name" => __( "Budget Calculator", "insivia" ),
    	"base" => "insivia_budget_calc",
    	"class" => "",
    	"category" => __( "Insivia Shortcodes", "insivia")
    ));
	
  	vc_map( array(
    	"name" => __( "Software Library", "insivia" ),
    	"base" => "software_library",
    	"class" => "",
    	"category" => __( "Insivia Shortcodes", "insivia"),
    	"params" => array(
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Text", "insivia" ),
	            "param_name" => "thetext",
	            "value" => __( "Default param value", "insivia" ),
	            "description" => __( "Description for foo param.", "insivia" )
	         )
	     )
    ));
	
  	vc_map( array(
    	"name" => __( "Innovations Section", "insivia" ),
    	"base" => "innovations_section",
    	"class" => "",
    	"category" => __( "Insivia Shortcodes", "insivia"),
    	"params" => array(
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Category", "insivia" ),
	            "param_name" => "category",
	            "value" => __( "356", "insivia" ),
	            "description" => __( "A category to display", "insivia" )
	         )
	     )
    ));
	
  	vc_map( array(
    	"name" => __( "Customizable Footer", "insivia" ),
    	"base" => "custom_footer_section",
    	"class" => "",
    	"category" => __( "Insivia Shortcodes", "insivia"),
    	"params" => array(
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Headline", "insivia" ),
	            "param_name" => "headline",
	            "value" => __( "", "insivia" ),
	            "description" => __( "Header Text", "insivia" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Subline", "insivia" ),
	            "param_name" => "subline",
	            "value" => __( "", "insivia" ),
	            "description" => __( "Header Subline Text", "insivia" )
	         )
	     )
    ));
  }
  add_action( 'vc_before_init', 'custom_integrateWithVC', 999999999 );
  
  //Not Sure
  function insivia_vc_row(){
  
      function get_attach_video($settings,$value){
  
        $dependency = vc_generate_dependencies_attributes( $settings );
  
        $value=intval($value);
  
        $video='';
  
        if($value){
          $media_url=wp_get_attachment_url($value);
          $mediadata=wp_get_attachment_metadata($value);
          $video='<video class="attached_video" data-id="'.$value.'" autoplay width="266">
          <source src="'.$media_url.'" type="video/'.$mediadata['fileformat'].'" /></video>';
        }
  
        $param_line = '<div class="attach_video_field" '.$dependency.'>';
        $param_line .= '<input type="hidden" class="wpb_vc_param_value '.$settings['param_name'].' '.$settings['type'].'" name="'.$settings['param_name'].'" value="'.($value?$value:'').'"/>';
        $param_line .= '<div class="gallery_widget_attached_videos">';
        $param_line .= '<ul class="gallery_widget_attached_videos_list">';
        $param_line .= '<li><a class="gallery_widget_add_video" href="#" title="'.__('Add Video', "insivia").'">'.($video!=''?$video:__('Add Video', "insivia")).'</a>';
        $param_line .= '<a href="#" style="display:'.($video!=''?"block":"none").'" class="remove_attach_video">'.__('Remove Video', "insivia").'</a></li>';
        $param_line .= '</ul>';
        $param_line .= '</div>';
        $param_line .= '</div>';
  
        return $param_line;
  
      }
   
      add_shortcode_param( 'attach_video', 'get_attach_video', get_template_directory_uri()."/inc/js/vc_editor.min.js");
  
       vc_add_param( 'vc_row', array( 
            'heading' => __( 'Expand section width', 'insivia' ),
            'param_name' => 'expanded',
            'class' => '',
            'value' => array(__('Expand Column','insivia')=>'1',__('Expand Background','insivia')=>'2'),
            'description' => __( 'Make section "out of the box".', 'insivia' ),
            'type' => 'checkbox',
            'group'=>__('Extended options', 'insivia')
        ) );
  
       vc_add_param( 'vc_row',   array( 
              'heading' => __( 'Background Type', 'insivia' ),
              'param_name' => 'background_type',
              'value' => array('image'=>__( 'Image', 'insivia' ),'video'=>__( 'Video', 'insivia' )),
              'type' => 'radio',
              'group'=>__('Extended options', 'insivia'),
              'std'=>'image'
           ));
  
       vc_add_param( 'vc_row', array( 
            'heading' => __( 'Background Video', 'insivia' ),
            'param_name' => 'background_video',
            'type' => 'attach_video',
            'group'=>__('Extended options', 'insivia'),
            'dependency' => array( 'element' => 'background_type', 'value' => array('video') )   
        ) );
  
       vc_add_param( 'vc_row', array( 
            'heading' => __( 'Background Image', 'insivia' ),
            'param_name' => 'background_image',
            'type' => 'attach_image',
            'group'=>__('Extended options', 'insivia'),
            'dependency' => array( 'element' => 'background_type', 'value' => array('image') )   
        ) );
  
       vc_add_param( 'vc_row', array( 
            'heading' => __( 'Extra id', 'insivia' ),
            'param_name' => 'el_id',
            'type' => 'textfield',
            "description" => __("If you wish to add anchor id to this row. Anchor id may used as link like href=\"#yourid\"", "insivia"),
        ) );
  
  
       vc_add_param( 'vc_row_inner', array( 
            'heading' => __( 'Extra id', 'insivia' ),
            'param_name' => 'el_id',
            'type' => 'textfield',
            "description" => __("If you wish to add anchor id to this row. Anchor id may used as link like href=\"#yourid\"", "insivia"),
        ) );
  
        vc_add_param( 'vc_row', array( 
            'heading' => __( 'Background Style', 'insivia' ),
            'param_name' => 'background_style',
            'type' => 'dropdown',
            'value'=>array(
                  __("Cover", 'insivia') => 'cover',
                  __('Contain', 'insivia') => 'contain',
                  __('No Repeat', 'insivia') => 'no-repeat',
                  __('Repeat', 'insivia') => 'repeat',
                  __("Parallax", 'insivia') => 'parallax',
                 __("Fixed", 'insivia') => 'fixed',
                ),
            'group'=>__('Extended options', 'insivia'),
            'dependency' => array( 'element' => 'background_type', 'value' => array('image') )       
        ) );
  	  
  }
  add_action('init','insivia_vc_row');

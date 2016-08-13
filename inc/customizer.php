<?php
/**
 * Insivia Base Theme Customizer.
 *
 * @package Insivia_Base
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function insivia_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_section('background_image');
}
add_action( 'customize_register', 'insivia_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function insivia_customize_preview_js() {
	wp_enqueue_script( 'insivia_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'insivia_customize_preview_js' );


function insivia_customizer_header_register( $wp_customize ) {

	$wp_customize->add_setting('header_logo', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '',
		'transport' => '',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'control_logo_upload', array(
		'label'    => __( 'Upload Logo', 'insivia' ),
		'section'  => 'title_tagline',
		'settings' => 'header_logo',
	) ) );

}
add_action( 'customize_register', 'insivia_customizer_header_register' );
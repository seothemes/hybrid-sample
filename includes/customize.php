<?php
/**
 * Handles the customizer features for the theme.
 *
 * @package    HybridSample
 * @author     SEO Themes <seothemeswp@gmail.com>
 * @copyright  Copyright (c) '93 - Infinity, SEO Themes
 * @link       http://seothemes.net/themes/hybrid-sample
 * @license    GPL 2.0
 */

// Theme Customizer setup.
add_action( 'customize_register', 'hybrid_sample_customize_register' );

/**
 * Sets up the theme customizer sections, controls, and settings.
 *
 * @access public
 * @param  object $wp_customize.
 * @return void
 */
function hybrid_sample_customize_register( $wp_customize ) {

	// Load JavaScript files.
	add_action( 'customize_preview_init', 'hybrid_sample_enqueue_customizer_scripts' );

	// Enable live preview for WordPress theme features.
	$wp_customize->get_setting( 'blogname' )->transport              = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport       = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'header_image' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'background_image' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'background_position_x' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_repeat' )->transport     = 'postMessage';
	$wp_customize->get_setting( 'background_attachment' )->transport = 'postMessage';
}

/**
 * Loads theme customizer JavaScript.
 *
 * @access public
 * @return void
 */
function hybrid_sample_enqueue_customizer_scripts() {
	// Use the .min script if SCRIPT_DEBUG is turned off.
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script(
		'hybrid-sample-customize',
		trailingslashit( get_template_directory_uri() ) . "assets/scripts/customize{$suffix}.js",
		array( 'jquery' ),
		null,
		true
	);
}

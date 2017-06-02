<?php
/**
 * Handles the custom header feature for the theme.
 *
 * This feature allows the theme or child theme author to
 * set a custom header by default. However the user can 
 * overwrite this default header via the theme customizer
 * to an image or video of their choosing.
 *
 * @package    HybridSample
 * @author     SEO Themes <seothemeswp@gmail.com>
 * @copyright  Copyright (c) '93 - Infinity, SEO Themes
 * @link       http://seothemes.net/themes/hybrid-sample
 * @license    GPL 2.0
 */

// Call late so child themes can override.
add_action( 'after_setup_theme', 'hybrid_sample_custom_header_setup', 15 );

/**
 * Adds support for the WordPress 'custom-header' theme feature and registers custom headers.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_sample_custom_header_setup() {

	add_theme_support(
		'custom-header',
		array(
			'default-image'          => get_template_directory_uri() . '/assets/images/hero.jpg',
			'random-default'         => false,
			'width'                  => 1280,
			'height'                 => 400,
			'flex-width'             => true,
			'flex-height'            => true,
			'default-text-color'     => '333333',
			'header-text'            => true,
			'uploads'                => true,
			'video'					 => true,
			'wp-head-callback'       => 'hybrid_sample_custom_header_wp_head',
		)
	);

	// Registers default headers for the theme.
	register_default_headers( array(
		'hero' => array(
			'url'           => '%s/assets/images/hero.jpg',
			'thumbnail_url' => '%s/assets/images/hero.jpg',
			'description'   => __( 'Hero Image', 'hybrid-sample' ),
		),
	));
}

/**
 * Callback function for outputting the custom header CSS to `wp_head`.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_sample_custom_header_wp_head() {

	if ( ! display_header_text() ) {
		return;
	}

	$hex = get_header_textcolor();

	// Return early if empty or equal to default.
	if ( ! $hex || '333333' === $hex ) {
		return;
	}

	$style = ".custom-header .site-title a,.custom-header .site-description{color:#{$hex};}";

	echo "\n" . '<style type="text/css" id="custom-header-css">' . esc_html( trim( $style ) ) . '</style>' . "\n";
}

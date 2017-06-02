<?php
/**
 * Handles the custom background feature for the theme.
 *
 * This feature allows the theme or child theme author to
 * set a custom background by default. However the user can
 * overwrite this default background via the theme customizer
 * to an image or color of their choosing.
 *
 * @package    HybridSample
 * @author     SEO Themes <seothemeswp@gmail.com>
 * @copyright  Copyright (c) '93 - Infinity, SEO Themes
 * @link       http://seothemes.net/themes/hybrid-sample
 * @license    GPL 2.0
 */

// Call late so child themes can override.
add_action( 'after_setup_theme', 'hybrid_sample_custom_background_setup', 15 );

/**
 * Adds support for the WordPress 'custom-background' theme feature.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_sample_custom_background_setup() {

	add_theme_support(
		'custom-background',
		array(
			'default-color'    => 'eeeeee',
			'default-image'    => '',
			'wp-head-callback' => 'hybrid_sample_custom_background_callback',
		)
	);
}

/**
 * This is a fix for when a user sets a custom background color with no custom background image.  What
 * happens is the theme's background image hides the user-selected background color.  If a user selects a
 * background image, we'll just use the WordPress custom background callback.  This also fixes WordPress
 * not correctly handling the theme's default background color.
 *
 * @link http://core.trac.wordpress.org/ticket/16919
 * @link http://core.trac.wordpress.org/ticket/21510
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_sample_custom_background_callback() {

	// Get the background image.
	$image = get_background_image();

	// If there's an image, just call the normal WordPress callback. We won't do anything here.
	if ( $image ) {
		_custom_background_cb();
		return;
	}

	// Get the background color.
	$color = get_background_color();

	// If no background color, return.
	if ( ! $color ) {
		return;
	}

	// Use 'background' instead of 'background-color'.
	$style = "background: #{$color};";

	if ( $color !== 'ffffff' ) {
		?>
		<style type="text/css" id="custom-background-css">body.custom-background { <?php echo trim( $style ); ?> }</style>
		<?php
	}
}

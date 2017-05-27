<?php
/**
 * This file contains all of the theme specific Hybrid Core functionality.
 *
 * @package    HybridBase
 * @subpackage Theme
 * @version    1.0.0
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2013 - 2015, Justin Tadlock
 * @link       http://themehybrid.com/themes/hybrid-base
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Register custom image sizes.
add_action( 'init', 'hybrid_base_register_image_sizes', 5 );

// Register custom menus.
add_action( 'init', 'hybrid_base_register_menus', 5 );

// Register custom layouts.
add_action( 'hybrid_register_layouts', 'hybrid_base_register_layouts' );

// Register sidebars.
add_action( 'widgets_init', 'hybrid_base_register_sidebars', 5 );

// Add custom scripts.
add_action( 'wp_enqueue_scripts', 'hybrid_base_enqueue_scripts', 5 );

// Add custom styles.
add_action( 'wp_enqueue_scripts', 'hybrid_base_enqueue_styles',  5 );

// HTML tag attributes.
add_filter( 'hybrid_attr_html', 'hybrid_base_attr_html', 5 );

// Remove excessive body classes.
add_filter( 'hybrid_attr_body', 'hybrid_base_body_class_filter' );

// Remove excessive post classes.
add_filter( 'hybrid_attr_post', 'hybrid_base_post_class_filter' );

// Remove excessive comment attributes.
add_filter( 'hybrid_attr_comment', 'hybrid_base_comment_class_filter' );

// Modify site title output.
add_filter( 'hybrid_attr_site-title', 'hybrid_base_attr_site_title' );

// Modify site description output.
add_filter( 'hybrid_attr_site-description', 'hybrid_base_attr_site_description' );


/**
 * Registers custom image sizes for the theme.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_register_image_sizes() {

	// Sets the 'post-thumbnail' size.
	//set_post_thumbnail_size( 150, 150, true );
}

/**
 * Registers nav menu locations.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_register_menus() {

	register_nav_menu( 'primary',    esc_html_x( 'Primary',    'nav menu location', 'hybrid-base' ) );

	register_nav_menu( 'secondary',  esc_html_x( 'Secondary',  'nav menu location', 'hybrid-base' ) );
}

/**
 * Registers layouts.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_register_layouts() {

	hybrid_register_layout( 'full-width', array(
		'label' => esc_html__( 'Full Width',
		'hybrid-base' ), 'image' => '%s/assets/images/layouts/full-width.png',
	) );

	hybrid_register_layout( 'sidebar-left', array(
		'label' => esc_html__( 'Sidebar Left', 'hybrid-base' ),
		'image' => '%s/assets/images/layouts/sidebar-left.png',
	) );

	hybrid_register_layout( 'sidebar-right', array(
		'label' => esc_html__( 'Sidebar Right', 'hybrid-base' ),
		'image' => '%s/assets/images/layouts/sidebar-right.png',
	) );	
}

/**
 * Registers sidebars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => esc_html_x( 'Primary', 'sidebar', 'hybrid-base' ),
			'description' => esc_html__( 'Add sidebar description.', 'hybrid-base' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'secondary',
			'name'        => esc_html_x( 'Secondary', 'sidebar', 'hybrid-base' ),
			'description' => esc_html__( 'Add sidebar description.', 'hybrid-base' )
		)
	);
}

/**
 * Load scripts for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_enqueue_scripts() {

	// Load Hybrid menu-toggle script.
	wp_enqueue_script( 'hybrid-mobile-toggle' );
}

/**
 * Load stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_enqueue_styles() {

	// Load one-five base style.
	wp_enqueue_style( 'hybrid-one-five' );

	// Load gallery style if 'cleaner-gallery' is active.
	if ( current_theme_supports( 'cleaner-gallery' ) ) {
		wp_enqueue_style( 'hybrid-gallery' );
	}

	// Load parent theme stylesheet if child theme is active.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'hybrid-parent' );
	}

	// Load active theme stylesheet.
	wp_enqueue_style( 'hybrid-style' );
}

/**
 * HTML tag attributes.
 *
 * @since  1.0.0
 * @access public
 * @param  array $attr Site title attributes.
 * @return array
 */
function hybrid_base_attr_html( $attr ) {

	$attr['class'] = 'no-js';
	$attr['lang']  = get_locale();

	return $attr;
}

/**
 * Filters the WordPress body class with a better set of classes
 * that are more consistently handled and are backwards compatible
 * with the original body class functionality that existed prior
 * to WordPress core adopting this feature.
 *
 * @since  1.0.0
 * @access public
 * @param  array $attr Body attributes.
 * @return array
 */
function hybrid_base_body_class_filter( $attr ) {

	// Emulate hover effects on mobile devices.
	$attr['ontouchstart'] = ' ';

	// Empty arrays.
	$class = '';
	$classes = array();

	// Right to left.
	if ( is_rtl() ) {
		$classes[] = 'rtl';
	}

	// Front page.
	if ( is_front_page() ) {
		$classes[] = 'home';
	}

	// Posts page.
	if ( is_home() ) {
		$classes[] = 'blog';
	}

	// Single post or page.
	if ( is_single() ) {
		$classes[] = 'single';
	}

	// Archive page.
	if ( is_archive() ) {
		$classes[] = 'archive';
	}

	// Date archives.
	if ( is_date() ) {
		$classes[] = 'date';
	}

	// Search results.
	if ( is_search() ) {
		$classes[] = 'search';
	}

	// Paged.
	if ( is_paged() ) {
		$classes[] = 'paged';
	}

	// Attachment pages.
	if ( is_attachment() ) {
		$classes[] = 'attachment';
	}

	// 404 pages.
	if ( is_404() ) {
		$classes[] = 'error404';
	}

	// Is the current user logged in.
	if ( is_user_logged_in() ) {
		$classes[] = 'logged-in';
	}

	// WP admin bar.
	if ( is_admin_bar_showing() ) {
		$classes[] = 'admin-bar';
	}

	// Add the '.wp-custom-logo' class if one is set.
	if ( has_custom_logo() ) {
		$classes[] = 'wp-custom-logo';
	}

	// Add the '.custom-background' class if one is set.
	if ( get_background_image() || get_background_color() ) {
		$classes[] = 'custom-background';
	}

	// Add the '.custom-header' class if one is set.
	if ( get_header_image() || ( display_header_text() && get_header_textcolor() ) ) {
		$classes[] = 'custom-header';
	}

	// Theme layouts.
	if ( current_theme_supports( 'theme-layouts' ) ) {
		$classes[] = sanitize_html_class( hybrid_get_theme_layout() );
	}

	// Add any additional unwanted classes here.
	$blacklist = array(
		'wp-featherlight-captions',
	);

	// Remove blacklisted class from array.
	$classes = array_diff( $classes, $blacklist );

	// Remove duplicate classes.
	$classes = array_unique( $classes );

	// Convert array of classes into string.
	$attr['class'] = implode( ' ', $classes );

	return $attr;
}

/**
 * Site title attributes.
 *
 * @since  1.0.0
 * @access public
 * @param  array $attr Site title attributes.
 * @return array
 */
function hybrid_base_attr_site_title( $attr ) {

	unset( $attr['id'] );

	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'http://schema.org/Organization';

	return $attr;
}

/**
 * Site description attributes.
 *
 * @since  1.0.0
 * @access public
 * @param  array $attr Site description attributes.
 * @return array
 */
function hybrid_base_attr_site_description( $attr ) {

	unset( $attr['id'] );

	return $attr;
}

/**
 * Filters the WordPress post class with a better set of classes
 * that are more consistently handled and are backwards compatible
 * with the original post class functionality that existed prior
 * to WordPress core adopting this feature.
 *
 * @since  1.0.0
 * @access public
 * @param  array $attr Post attributes.
 * @return array
 */
function hybrid_base_post_class_filter( $attr ) {

	unset( $attr['id'] );
	$attr['class'] = 'entry';

	// Sticky class for sticky posts.
	if ( is_sticky( get_the_id() ) ) {
		if ( is_home() && ! is_paged() ) {
			$attr['class'] .= ' sticky';
		}
	}

	return $attr;
}

/**
 * Adds custom classes to WordPress comments.
 *
 * @since  1.0.0
 * @access public
 * @param  array $attr Comment attributes.
 * @return array
 */
function hybrid_base_comment_class_filter( $attr ) {

	$attr['class'] = 'comment';

	return $attr;
}
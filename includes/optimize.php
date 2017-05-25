<?php
/**
 * Theme optimizations.
 *
 * This file contains WordPress and Hybrid optimizations to remove
 * all of the unused functionality for the Hybrid Base theme.
 * This is what makes it an SEO Themes theme.
 *
 * @package      Hybrid Base
 * @link         https://seothemes.net/store-pro
 * @author       Seo Themes
 * @copyright    Copyright © 2017 Seo Themes
 * @license      GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Remove hooks.
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove filters.
remove_filter( 'the_title', 'capital_P_dangit', 11 );
remove_filter( 'the_content', 'capital_P_dangit', 11 );
remove_filter( 'comment_text', 'capital_P_dangit', 31 );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

// Add hooks.
add_action( 'init', 'hybrid_base_head_cleanup' );
add_action( 'wp_enqueue_scripts', 'hybrid_base_move_js_to_footer', 99 );
add_action( 'wp_enqueue_scripts', 'hybrid_base_register_jquery', 100 );
add_action( 'wp_head', 'hybrid_base_jquery_local_fallback' );

// Add filters.
add_filter( 'use_default_gallery_style', '__return_false' );
add_filter( 'emoji_svg_url', '__return_false' );
add_filter( 'style_loader_src', 'hybrid_base_remove_version_query', 10, 2 );
add_filter( 'script_loader_src', 'hybrid_base_remove_version_query', 10, 2 );
add_filter( 'script_loader_tag', 'hybrid_base_clean_script_tag' );
add_filter( 'nav_menu_css_class', 'hybrid_base_menu_class_filter', 100, 1 );
add_filter( 'nav_menu_item_id', 'hybrid_base_menu_class_filter', 100, 1 );
add_filter( 'get_avatar', 'hybrid_base_remove_self_closing_tags' );
add_filter( 'comment_id_fields', 'hybrid_base_remove_self_closing_tags' );
add_filter( 'post_thumbnail_html', 'hybrid_base_remove_self_closing_tags' );
add_filter( 'get_bloginfo_rss', 'hybrid_base_remove_default_description' );
add_filter( 'the_content', 'hybrid_base_remove_ptags_on_images' );

// Hybrid core actions.
remove_action( 'wp_head', 'hybrid_meta_charset',   0 );
remove_action( 'wp_head', 'hybrid_meta_viewport',  1 );
remove_action( 'wp_head', 'hybrid_meta_generator', 1 );
remove_action( 'wp_head', 'hybrid_link_pingback',  3 );

// Hybrid core filters.
add_filter( 'hybrid_attr_body', 'hybrid_base_body_class_filter' );
add_filter( 'hybrid_attr_post', 'hybrid_base_post_class_filter' );
add_filter( 'hybrid_attr_comment', 'hybrid_base_comment_class_filter' );
add_filter( 'hybrid_attr_site-title', 'hybrid_base_attr_site_title' );
add_filter( 'hybrid_attr_site-description', 'hybrid_base_attr_site_description' );

/**
 * Filters the WordPress body class with a better set of classes that are more consistently handled and
 * are backwards compatible with the original body class functionality that existed prior to WordPress
 * core adopting this feature.
 *
 * @since  2.0.0
 * @access public
 * @param  array        $classes
 * @param  string|array $class
 * @return array
 */
function hybrid_base_body_class_filter( $attr ) {

	// Emulate hover effects on mobile devices.
	$attr['ontouchstart'] = ' ';

	// Empty arrays.
	$class = '';
	$classes = array();

	// Right to left.
	if ( is_rtl() )
		$classes[] = 'rtl';

	// Front page.
	if ( is_front_page() )
		$classes[] = 'home';

	// Posts page.
	if ( is_home() )
		$classes[] = 'blog';

	// Single post or page.
	if ( is_single() )
		$classes[] = 'single';

	// Archive page.
	if ( is_archive() )
		$classes[] = 'archive';

	// Date archives.
	if ( is_date() )
		$classes[] = 'date';

	// Search results.
	if ( is_search() )
		$classes[] = 'search';

	// Paged.
	if ( is_paged() )
		$classes[] = 'paged';

	// Attachment pages.
	if ( is_attachment() )
		$classes[] = 'attachment';

	// 404 pages.
	if ( is_404() )
		$classes[] = 'error404';

	// Is the current user logged in.
	if ( is_user_logged_in() )
		$classes[] = 'logged-in';

	// WP admin bar.
	if ( is_admin_bar_showing() )
		$classes[] = 'admin-bar';

	// Add the '.wp-custom-logo' class if one is set.
	if ( has_custom_logo() )
		$classes[] = 'wp-custom-logo';

	// Add the '.custom-background' class if one is set.
	if ( get_background_image() || get_background_color() )
		$classes[] = 'custom-background';

	// Add the '.custom-header' class if one is set.
	if ( get_header_image() || ( display_header_text() && get_header_textcolor() ) )
		$classes[] = 'custom-header';

	// Theme layouts.
	if ( current_theme_supports( 'theme-layouts' ) )
		$classes[] = sanitize_html_class( hybrid_get_theme_layout() );

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
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybrid_base_attr_site_title( $attr ) {

	unset( $attr['id'] );

	return $attr;
}

/**
 * Site description attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybrid_base_attr_site_description( $attr ) {

	unset( $attr['id'] );

	return $attr;
}

/**
 * Filters the WordPress post class with a better set of classes that are more consistently handled and
 * are backwards compatible with the original post class functionality that existed prior to WordPress
 * core adopting this feature.
 *
 * @since  2.0.0
 * @access public
 * @param  array        $classes
 * @param  string|array $class
 * @param  int          $post_id
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
 * Adds custom classes to the WordPress comment class.
 *
 * @since  2.0.0
 * @access public
 * @param  array        $classes
 * @param  string|array $class
 * @param  int          $comment_id
 * @return array
 */
function hybrid_base_comment_class_filter( $attr ) {

	$attr['class'] = 'comment';

	return $attr;
}

/**
 * Return an empty variable.
 *
 * @param  array $atts Given attributes.
 * @return array $atts Empty attributes.
 */
function hybrid_base_return_empty( $atts ) {

	$atts = '';
	return $atts;
}

/**
 * Clean up wp_head.
 */
function hybrid_base_head_cleanup() {

	global $wp_widget_factory;

	// Remove recent comments css.
	if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
		remove_action( 'wp_head', [ $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ] );
	}

	// Remove comments feed.
	add_action( 'wp_head', 'ob_start', 1, 0 );
	add_action( 'wp_head', function () {
		$pattern = '/.*' . preg_quote( esc_url( get_feed_link( 'comments_' . get_default_feed() ) ), '/' ) . '.*[\r\n]+/';
		echo preg_replace( $pattern, '', ob_get_clean() );
	}, 3, 0);
}

/**
 * Move all JS to footer.
 */
function hybrid_base_move_js_to_footer() {

	$scripts = wp_scripts();
	foreach ( $scripts->registered as $script ) {
		if ( 'html5' === $script->handle ) {
			wp_script_add_data( $script->handle, 'group', 0 );
		} else {
			wp_script_add_data( $script->handle, 'group', 1 );
		}
	}
}

/**
 * Don't return the default description in the
 * RSS feed if it hasn't been changed.
 *
 * @param string $bloginfo Site tagline.
 */
function hybrid_base_remove_default_description( $bloginfo ) {
	$default_tagline = 'Just another WordPress site';
	return ( $bloginfo === $default_tagline ) ? '' : $bloginfo;
}

/**
 * Remove query string from static files.
 *
 * @param  string $src The string.
 * @return string $src The string.
 */
function hybrid_base_remove_version_query( $src ) {

	if ( strpos( $src, '?ver=' ) || strpos( $src, '&ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}

/**
 * Remove unnecessary self-closing tags
 *
 * @param string $input The input strings.
 */
function hybrid_base_remove_self_closing_tags( $input ) {
	return str_replace( ' />', '>', $input );
}

/**
 * Clean up output of <script> tags.
 *
 * @param string $input Scripts.
 */
function hybrid_base_clean_script_tag( $input ) {
	$input = str_replace( "type='text/javascript' ", '', $input );
	return str_replace( "'", '"', $input );
}

/**
 * Remove tinymce emoji plugin.
 *
 * @param  array $plugins Array of plugins.
 * @return array Removed from plugins.
 */
function hybrid_base_remove_tinymce_emojis( $plugins ) {
	if ( ! is_array( $plugins ) ) {
		return array();
	}
	return array_diff( $plugins, array( 'wpemoji' ) );
}

/**
 * Remove excessive menu-item classes.
 *
 * @param  array $var Too many classes.
 * @return array Only necessary classes.
 */
function hybrid_base_menu_class_filter( $var ) {

	if ( ! is_array( $var ) ) {
		return '';
	}

	// Add needed classes here.
	$var = array_intersect( $var, array(
		'current-menu-item',
		'menu-item',
		'menu-item-has-children',
	) );
	return $var;
}

/**
 * Remove p tags from around images.
 *
 * @link   http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
 * @param  string $content Default content.
 * @return string Filtered content.
 */
function hybrid_base_remove_ptags_on_images( $content ) {
	return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}

/**
 * Load jQuery from jQuery's CDN with a local fallback.
 */
function hybrid_base_register_jquery() {
	$jquery_version = wp_scripts()->registered['jquery']->ver;
	wp_deregister_script( 'jquery' );
	wp_register_script(
		'jquery',
		'https://code.jquery.com/jquery-' . $jquery_version . '.min.js',
		[],
		null,
		true
	);
	add_filter( 'wp_resource_hints', function ( $urls, $relation_type ) {
		if ( 'dns-prefetch' === $relation_type ) {
			$urls[] = 'code.jquery.com';
		}
		return $urls;
	}, 10, 2);
	add_filter( 'script_loader_src', 'hybrid_base_jquery_local_fallback', 10, 2 );
}

/**
 * Output the local fallback immediately after jQuery's <script>
 *
 * @link http://wordpress.stackexchange.com/a/12450
 * @param string $src jQUery source.
 * @param string $handle Theme handle.
 */
function hybrid_base_jquery_local_fallback( $src, $handle = null ) {
	static $add_jquery_fallback = false;
	if ( $add_jquery_fallback ) {
		echo '<script>(window.jQuery && jQuery.noConflict()) || document.write(\'<script src="' . $add_jquery_fallback . '"><\/script>\')</script>' . "\n";
		$add_jquery_fallback = false;
	}
	if ( 'jquery' === $handle ) {
		$add_jquery_fallback = apply_filters( 'script_loader_src', \includes_url( '/js/jquery/jquery.js' ), 'jquery-fallback' );
	}
	return $src;
}

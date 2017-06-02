<?php
/**
 * Handles the Hybrid Core functionality for the theme.
 *
 * @package    HybridSample
 * @author     SEO Themes <seothemeswp@gmail.com>
 * @copyright  Copyright (c) '93 - Infinity, SEO Themes
 * @link       http://seothemes.net/themes/hybrid-sample
 * @license    GPL 2.0
 */

// Register custom menus.
add_action( 'init', 'hybrid_sample_register_menus', 5 );

// Register custom layouts.
add_action( 'hybrid_register_layouts', 'hybrid_sample_register_layouts' );

// Register sidebars.
add_action( 'widgets_init', 'hybrid_sample_register_sidebars', 5 );

// Add custom scripts.
add_action( 'wp_enqueue_scripts', 'hybrid_sample_enqueue_scripts', 5 );

// Add custom styles.
add_action( 'wp_enqueue_scripts', 'hybrid_sample_enqueue_styles',  5 );

// HTML tag attributes.
add_filter( 'hybrid_attr_html', 'hybrid_sample_attr_html', 5 );

// Remove excessive body classes.
add_filter( 'hybrid_attr_body', 'hybrid_sample_body_class_filter' );

// Remove excessive post classes.
add_filter( 'hybrid_attr_post', 'hybrid_sample_post_class_filter' );

// Hero attributes.
add_filter( 'hybrid_attr_hero', 'hybrid_sample_attr_hero', 5 );

// Remove excessive comment attributes.
add_filter( 'hybrid_attr_comment', 'hybrid_sample_comment_class_filter' );

// Modify site title output.
add_filter( 'hybrid_site_title', 'hybrid_sample_site_title' );

// Modify site title output.
add_filter( 'hybrid_attr_site-title', 'hybrid_sample_attr_site_title' );

// Modify site description output.
add_filter( 'hybrid_site_description', 'hybrid_sample_site_description' );

// Modify site description output.
add_filter( 'hybrid_attr_site-description', 'hybrid_sample_attr_site_description' );

// Filter tag cloud font size.
add_filter( 'widget_tag_cloud_args', 'hybrid_sample_tag_cloud_filter', 90 );

// Filter the read more link.
add_filter( 'excerpt_more', 'hybrid_sample_read_more' );
add_filter( 'the_content_more_link', 'hybrid_sample_read_more' );
add_filter( 'get_the_content_more_link', 'hybrid_sample_read_more' );

/**
 * Registers nav menu locations.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_sample_register_menus() {

	register_nav_menu( 'primary',    esc_html_x( 'Primary',    'nav menu location', 'hybrid-sample' ) );
	register_nav_menu( 'secondary',  esc_html_x( 'Secondary',  'nav menu location', 'hybrid-sample' ) );
	register_nav_menu( 'footer',  esc_html_x( 'Footer',  'nav menu location', 'hybrid-sample' ) );
}

/**
 * Registers layouts.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_sample_register_layouts() {

	hybrid_register_layout( 'full-width', array(
		'label' => esc_html__( 'Full Width',
		'hybrid-sample' ), 'image' => '%s/assets/images/layouts/full-width.png',
	) );
	hybrid_register_layout( 'sidebar-left', array(
		'label' => esc_html__( 'Sidebar Left', 'hybrid-sample' ),
		'image' => '%s/assets/images/layouts/sidebar-left.png',
	) );
	hybrid_register_layout( 'sidebar-right', array(
		'label' => esc_html__( 'Sidebar Right', 'hybrid-sample' ),
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
function hybrid_sample_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'hero',
			'name'        => esc_html_x( 'Hero', 'sidebar', 'hybrid-sample' ),
			'description' => esc_html__( 'The hero widget area.', 'hybrid-sample' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h1>',
			'after_title'   => '</h1>',
		)
	);
	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => esc_html_x( 'Sidebar', 'sidebar', 'hybrid-sample' ),
			'description' => esc_html__( 'The sidebar widget area.', 'hybrid-sample' )
		)
	);
	hybrid_register_sidebar(
		array(
			'id'          => 'footer',
			'name'        => esc_html_x( 'Footer', 'sidebar', 'hybrid-sample' ),
			'description' => esc_html__( 'The footer widget area.', 'hybrid-sample' )
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
function hybrid_sample_enqueue_scripts() {

	$version = '0.1.0';
	$js_url  = get_stylesheet_directory_uri() . '/assets/scripts/';
	$suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'hybrid-sample-menu', $js_url . "menus{$suffix}.js", array( 'jquery' ), $version, true );
	wp_localize_script(
		'hybrid-sample-menu',
		'hybrid_menu',
		hybrid_sample_menu_settings()
	);
}

/**
 * Responsive menu settings.
 */
function hybrid_sample_menu_settings() {
	$settings = array(
		'mainMenu'          => __( 'Menu', 'hybrid-sample' ),
		'subMenu'           => __( 'Submenu', 'hybrid-sample' ),
		'menuClasses'       => array(
			'combine' => array(
				'.menu-primary',
				'.menu-secondary',
			),
			'others'  => array(),
		),
	);
	return $settings;
}

/**
 * Load stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_sample_enqueue_styles() {

	// Load parent theme stylesheet if child theme is active.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'hybrid-parent' );
	}

	// Load active theme stylesheet.
	wp_enqueue_style( 'hybrid-style' );

	// Google fonts.
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), '' );

}

/**
 * Helper wrap function.
 *
 * Simply echoes the `hybrid_get_wrap` helper function.
 *
 * @since  1.0.0
 * @access public
 * @param  string $args Provided args.
 * @return void
 */
function hybrid_wrap( $args = '' ) {
	echo wp_kses( hybrid_get_wrap( $args ), 'post' );
}

/**
 * Helper get wrap function.
 *
 * Abstracted here to allow theme developers to easily
 * change the wrapper div attributes. For example, bootstrap
 * uses the `container` class instead of `wrap`.
 *
 * @since  1.0.0
 * @access public
 * @param  string $args Provided args.
 * @return string Wrap markup.
 */
function hybrid_get_wrap( $args = '' ) {
	if ( 'open' === $args ) {
		return '<div class="wrap">';
	} elseif ( 'close' === $args ) {
		return '</div>';
	}
}

/**
 * Returns the linked site title wrapped in an `<b>` tag.
 *
 * @since  2.0.0
 * @access public
 * @return string
 */
function hybrid_sample_site_title() {
	$title = get_bloginfo( 'name' );
	return sprintf( '<b %s><a href="%s" rel="home">%s</a></b>', hybrid_get_attr( 'site-title' ), esc_url( home_url() ), $title );
}

/**
 * Returns the site description wrapped in an `<p>` tag.
 *
 * @since  2.0.0
 * @access public
 * @return string
 */
function hybrid_sample_site_description() {
	$desc = get_bloginfo( 'description' );
	return sprintf( '<p %s>%s</p>', hybrid_get_attr( 'site-description' ), $desc );
}

/**
 * HTML tag attributes.
 *
 * @since  1.0.0
 * @access public
 * @param  array $attr Site title attributes.
 * @return array
 */
function hybrid_sample_attr_html( $attr ) {
	$attr['class'] = 'no-js';
	$attr['lang']  = get_locale();
	return $attr;
}

/**
 * Hero section attributes.
 *
 * @since  1.0.0
 * @access public
 * @param  array $attr Site title attributes.
 * @return array
 */
function hybrid_sample_attr_hero( $attr ) {
	$attr['class'] = 'hero';
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
function hybrid_sample_body_class_filter( $attr ) {

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

	// Single page.
	if ( is_page() ) {
		$classes[] = 'page';
	}

	// Single post.
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

	// Customizer preview.
	if ( is_customize_preview() ) {
		$classes[] = 'customize-preview';
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
function hybrid_sample_attr_site_title( $attr ) {
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
function hybrid_sample_attr_site_description( $attr ) {
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
function hybrid_sample_post_class_filter( $attr ) {
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
function hybrid_sample_comment_class_filter( $attr ) {
	$attr['class'] = 'comment';
	return $attr;
}

/**
 * Tag cloud font size.
 *
 * This function will let you set a new min/max font size
 * for your tag cloud.
 *
 * @param array $args The tagcloud arguments.
 */
function hybrid_sample_tag_cloud_filter( $args = array() ) {
	$args['smallest'] = 14;
	$args['largest'] = 20;
	$args['unit'] = 'px';
	return $args;
}

/**
 * Accessible read more link.
 *
 * The below code modifies the default read more link when
 * using the WordPress More Tag to break a post on your site.
 * Instead of seeing 'Read more', screen readers will instead
 * see 'Read more about (entry title)'. This is a simple fix
 * to improve the overall user experience and should be in core.
 */
function hybrid_sample_read_more() {
	$trimtitle  = get_the_title();
	$shorttitle = wp_trim_words(
		$trimtitle,
		$num_words = 10,
		$more = '…'
	);
	return sprintf( '... <a class="more-link" rel="nofollow" href="%1$s">Read more<span class="screen-reader-text"> about %2$s</span></a>', esc_url( get_permalink() ), $shorttitle );
}

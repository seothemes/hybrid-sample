<?php
/**
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    HybridBase
 * @subpackage Functions
 * @version    1.0.0
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2013 - 2015, Justin Tadlock
 * @link       http://themehybrid.com/themes/hybrid-base
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Get the template directory and make sure it has a trailing slash.
$hybrid_base_dir = trailingslashit( get_template_directory() );

// Load the Hybrid Core framework and theme files.
require_once( $hybrid_base_dir . 'library/hybrid.php'        	  );
require_once( $hybrid_base_dir . 'includes/custom-background.php' );
require_once( $hybrid_base_dir . 'includes/custom-header.php'     );
require_once( $hybrid_base_dir . 'includes/theme.php'             );

// Launch the Hybrid Core framework.
new Hybrid();

// Do theme setup on the 'after_setup_theme' hook.
add_action( 'after_setup_theme', 'hybrid_base_theme_setup', 5 );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_theme_setup() {

	// The best thumbnail/image script ever.
	add_theme_support( 'get-the-image' );

	// Breadcrumbs. Yay!
	add_theme_support( 'breadcrumb-trail' );

	// Nicer [gallery] shortcode implementation.
	add_theme_support( 'cleaner-gallery' );

	// Automatically add feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Enable custom template hierarchy.
	add_theme_support( 'hybrid-core-template-hierarchy' );

	// Theme layouts.
	add_theme_support( 'theme-layouts', array(
		'default' => is_rtl() ? 'sidebar-left' : 'sidebar-right',
	) );

	// Enable post formats.
	add_theme_support( 'post-formats', array(
		'aside',
		'audio',
		'chat',
		'image',
		'gallery',
		'link',
		'quote',
		'status',
		'video',
	) );

	// Enable features from Soil plugin https://roots.io/plugins/soil/.
	add_theme_support( 'soil-clean-up' 		);
	add_theme_support( 'soil-nav-walker'    );
	add_theme_support( 'soil-nice-search'   );
	add_theme_support( 'soil-jquery-cdn'    );
	add_theme_support( 'soil-relative-urls' );

	// Handle content width for embeds and images.
	hybrid_set_content_width( 1280 );

	/**
	 * Load WordPress and Hybrid Core optimizations only if theme support
	 * is declared. This is not recommended for commercial themes and is
	 * only intended for use on personal projects to increase performance.
	 *
	 * To enable optimizations uncomment the following line:
	 * add_theme_support( 'optimize' );
	 */
	require_if_theme_supports( 'optimize', get_template_directory() . '/includes/optimize.php' );
}

<!doctype html>
<html <?php hybrid_attr( 'html' ); ?>>
	<head <?php hybrid_attr( 'head' ); ?>>
		<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
	</head>
	<body <?php hybrid_attr( 'body' ); ?>>
		<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->
		<div class="skip-link">
			<a href="#content" class="screen-reader-text"><?php esc_html_e( 'Skip to content', 'hybrid-sample' ); ?></a>
			<a href="#footer" class="screen-reader-text"><?php esc_html_e( 'Skip to footer', 'hybrid-sample' ); ?></a>
		</div><!-- .skip-link -->

		<header <?php hybrid_attr( 'header' ); ?>>

			<?php hybrid_wrap( 'open' ); ?>

				<?php if ( display_header_text() ) : // If user chooses to display header text. ?>

					<div <?php hybrid_attr( 'branding' ); ?>>
						<?php hybrid_site_title(); ?>
						<?php hybrid_site_description(); ?>
					</div><!-- #branding -->

				<?php endif; // End check for header text. ?>

				<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

			<?php hybrid_wrap( 'close' ); ?>

			<?php hybrid_get_menu( 'secondary' ); // Loads the menu/secondary.php template. ?>

			<?php if ( is_front_page() ) : // If on front page. ?>

				<?php hybrid_get_sidebar( 'hero' ); // Loads the sidebar/hero.php template. ?>

			<?php endif; // End check for header image. ?>

		</header><!-- #header -->

		<div id="main" class="site-inner">

			<?php hybrid_wrap( 'open' ); ?>

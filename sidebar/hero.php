<?php if ( is_active_sidebar( 'hero' ) ) : // If not a one-column layout. ?>

<section <?php hybrid_attr( 'hero' ); ?>>

	<?php hybrid_wrap( 'open' ); ?>

		<?php dynamic_sidebar( 'hero' ); // Displays the sidebar sidebar. ?>

	<?php hybrid_wrap( 'close' ); ?>

	<?php the_custom_header_markup(); // Displays the header image or video. ?>

</section>

<?php endif; // End widgets check. ?>
<?php if ( is_active_sidebar( 'footer' ) ) : // If the sidebar has widgets. ?>

	<aside <?php hybrid_attr( 'sidebar', 'footer' ); ?>>

	<?php hybrid_wrap( 'open' ); ?>

		<?php dynamic_sidebar( 'footer' ); // Displays the footer sidebar. ?>

	<?php hybrid_wrap( 'close' ); ?>

	</aside><!-- #sidebar-footer -->

<?php endif; // End widgets check. ?>
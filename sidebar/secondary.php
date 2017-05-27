<?php if ( is_active_sidebar( 'secondary' ) ) : // If the sidebar has widgets. ?>

	<aside <?php hybrid_attr( 'sidebar', 'secondary' ); ?>>

		<?php dynamic_sidebar( 'secondary' ); // Displays the secondary sidebar. ?>

	</aside><!-- #sidebar-secondary -->

<?php endif; // End widgets check. ?>
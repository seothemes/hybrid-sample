			<?php hybrid_get_sidebar( 'sidebar' ); // Loads the sidebar/primary.php template. ?>

			<?php hybrid_wrap( 'close' ); ?>

		</div><!-- #main -->

		<footer <?php hybrid_attr( 'footer' ); ?>>

			<?php hybrid_get_sidebar( 'footer' ); // Loads the sidebar/secondary.php template. ?>

			<?php hybrid_wrap( 'open' ); ?>

				<?php hybrid_get_menu( 'footer' ); // Loads the menu/footer.php template. ?>

				<p class="credit">
					<?php printf(
						// Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link, and 4 is theme name/link.
						esc_html__( 'Copyright &#169; %1$s %2$s. Powered by %3$s and %4$s.', 'hybrid-sample' ), 
						date_i18n( 'Y' ), hybrid_get_site_link(), hybrid_get_wp_link(), hybrid_get_theme_link()
					); ?>
				</p><!-- .credit -->

			<?php hybrid_wrap( 'close' ); ?>

		</footer><!-- #footer -->

	<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>
	</body>
</html>
		<?php hybrid_get_sidebar( 'primary' ); // Loads the sidebar/primary.php template. ?>

	</div><!-- #main -->

	<?php hybrid_get_sidebar( 'secondary' ); // Loads the sidebar/subsidiary.php template. ?>

	<?php hybrid_get_menu( 'secondary' ); // Loads the menu/secondary.php template. ?>

	<footer <?php hybrid_attr( 'footer' ); ?>>

		<p class="credit">
			<?php printf(
				// Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link, and 4 is theme name/link.
				esc_html__( 'Copyright &#169; %1$s %2$s. Powered by %3$s and %4$s.', 'hybrid-base' ), 
				date_i18n( 'Y' ), hybrid_get_site_link(), hybrid_get_wp_link(), hybrid_get_theme_link()
			); ?>
		</p><!-- .credit -->

	</footer><!-- #footer -->

<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>

</body>
</html>
<?php get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?>>

	<?php if ( ! is_front_page() && hybrid_is_plural() ) : // If viewing a multi-post page ?>

		<header <?php hybrid_attr( 'archive-header' ); ?>>

			<h1 <?php hybrid_attr( 'archive-title' ); ?>><?php the_archive_title(); ?></h1>

			<?php if ( ! is_paged() && $desc = get_the_archive_description() ) : // Check if we're on page/1. ?>

				<div <?php hybrid_attr( 'archive-description' ); ?>>
					<?php echo $desc; ?>
				</div><!-- .archive-description -->

			<?php endif; // End paged check. ?>

		</header><!-- .archive-header -->

	<?php endif; // End check for multi-post page. ?>

	<?php if ( have_posts() ) : // Checks if any posts were found. ?>

		<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

			<?php the_post(); // Loads the post data. ?>

			<?php hybrid_get_content_template(); // Loads the content/*.php template. ?>

			<?php if ( is_singular() ) : // If viewing a single post/page/CPT. ?>

				<?php comments_template( '', true ); // Loads the comments.php template. ?>

			<?php endif; // End check for single post. ?>

		<?php endwhile; // End found posts loop. ?>

		<?php locate_template( array( 'menu/loop-nav.php' ), true ); // Loads the menu/loop-nav.php template. ?>

	<?php else : // If no posts were found. ?>

		<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>

	<?php endif; // End check for posts. ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>
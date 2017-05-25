<?php
// If a post password is required or no comments are given and comments/pings are closed, return.
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
	return;
?>

<section id="comments-template">

	<?php if ( have_comments() ) : // Check if there are any comments. ?>

		<div id="comments">

			<h3 id="comments-number"><?php comments_number(); ?></h3>

			<ol class="comment-list">
				<?php wp_list_comments(
					array(
						'style'        => 'ol',
						'callback'     => 'hybrid_comments_callback',
						'end-callback' => 'hybrid_comments_end_callback'
					)
				); ?>
			</ol><!-- .comment-list -->

			<?php locate_template( array( 'comment/comments-nav.php' ), true ); // Loads the comment/comments-nav.php template. ?>

		</div><!-- #comments-->

	<?php endif; // End check for comments. ?>

	<?php locate_template( array( 'comment/comments-error.php' ), true ); // Loads the comment/comments-error.php template. ?>

	<?php comment_form(); // Loads the comment form. ?>

</section><!-- #comments-template -->
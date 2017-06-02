<li <?php hybrid_attr( 'comment' ); ?>>

	<article>
		<header class="comment-header">
			<?php echo get_avatar( $comment, 50 ); ?>
			<cite <?php hybrid_attr( 'comment-author' ); ?>><?php comment_author_link(); ?> commented</cite>
			<div class="comment-meta">
				<a <?php hybrid_attr( 'comment-permalink' ); ?>><time <?php hybrid_attr( 'comment-published' ); ?>><?php printf( esc_html__( '%s ago', 'hybrid-sample' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time></a>
				<?php edit_comment_link(); ?>
			</div>
		</header><!-- .comment-meta -->

		<div <?php hybrid_attr( 'comment-content' ); ?>>
			<?php comment_text(); ?>
		</div><!-- .comment-content -->

		<?php hybrid_comment_reply_link(); ?>
	</article>

<?php // No closing </li> is needed.  WordPress will know where to add it. ?>
<?php if ( function_exists( 'breadcrumb_trail' ) && ! is_page() ) : // Check for breadcrumb support. ?>

	<?php breadcrumb_trail(
		array(
			'container'     => 'nav',
			'separator'     => '/',
			'show_on_front' => false,
			'show_browse'	=> false,
			'before'		=> 'You are here:&nbsp;',
		)
	); ?>

<?php endif; // End check for breadcrumb support. ?>
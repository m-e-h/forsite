<?php
	while ( have_posts() ) {
		the_post();
		Hybrid\View\display( 'views/layouts', Hybrid\Template\hierarchy() );
	}

	Hybrid\View\display( 'views/components', 'nav-pagination', [ 'type' => 'posts' ] );

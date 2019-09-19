<main id="main" class="app-main">

<?= $engine->render( 'views/components', 'header-posts' ); ?>

<?php
have_posts() ?

$engine->display( 'views/components', 'post-loop' ) :

$engine->display( 'views/layouts', '404' );

// if ( have_posts() ) {

// 	while ( have_posts() ) {
// 		the_post();
// 		$engine->display( 'views/layouts', Hybrid\Template\hierarchy() );
// 	}

// 	$engine->display( 'views/components', 'nav-pagination', [ 'type' => 'posts' ] );

// } else {

// 	$engine->display( 'views/layouts', '404' );

// }
?>

</main>

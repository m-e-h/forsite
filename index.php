<?php
$engine = Hybrid\App::resolve( 'view/engine' );
$color1 = get_theme_mod( 'primary_color', Forsite\default_primary_color() );
?>

<?= $engine->render( false, 'header', [ 'color1' => $color1 ] ); ?>

<?= $engine->render( 'views', Hybrid\Template\hierarchy() ); ?>

<?= $engine->render( 'footer' ); ?>

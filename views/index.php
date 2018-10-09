<?= Hybrid\View\render( 'header' ); ?>

<?= Hybrid\View\render( 'layouts', Hybrid\Template\hierarchy() ); ?>

<?= Hybrid\View\render( 'sidebar', 'primary', [ 'sidebar' => 'primary' ] ); ?>

<?= Hybrid\View\render( 'footer' ); ?>

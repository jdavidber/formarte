<?php
/**
 * Right sidebar template file.
 *
 * Displayed only when at least one widget is active
 *
 * @package WordPress
 * @subpackage Nightly
 * @since 1.0
 */

?>

<?php if ( is_active_sidebar( 'nightly-right-sidebar' ) ) : ?>
    <div data-role="panel" data-display="<?php echo esc_html ( nightly_global('nightly_sidebar_transition') ); ?>" id="right-sidebar" data-position="right" data-theme="d">
    		 <?php dynamic_sidebar( 'nightly-right-sidebar' ); ?>
    </div> <!-- #right-sidebar -->
<?php endif; ?>
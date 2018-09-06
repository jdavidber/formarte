<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main-content and #page sections
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */

?>

    </div>
			
		<div data-role="footer" data-theme="none" data-border="false"<?php if ( nightly_global('nightly_footer_fixed') == true ) echo ' data-position="fixed"'; ?> data-tap-toggle="false" class="main-footer">
		
				<?php if ( is_active_sidebar( 'nightly-footer-widget-area' ) ) : ?>
				    <div class="nightly-footer-widget-area">
				    		 <?php dynamic_sidebar( 'nightly-footer-widget-area' ); ?>
				    </div> <!-- .nightly-footer-widget-area -->
				<?php endif; ?>
			
		    <p class="align-center"><?php echo html_entity_decode ( esc_html ( nightly_global('nightly_footer_text') ) ); ?></p>
		</div> 
		
		<?php if ( nightly_global('nightly_show_footer_info_bar') == true ) {
				nightly_footer_info_bar();
		} ?>	

	</div><!-- end page -->
	<?php wp_footer(); ?>
</body>
</html>
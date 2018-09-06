<?php
/**
 * The default template for displaying quote post
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("item entry-quote-post"); ?>>

	<div class="entry-content blog-prologue">
		<?php the_content('', FALSE, ''); ?>
	</div><!-- .entry-content -->
	
	<?php if ( is_single() ) :
	
		the_tags( '<div>Tagged in <span class="ui-tag" data-theme="'. get_option("nightly_theme").'">', '</span><span class="ui-tag" data-theme="'. get_option("nightly_theme").'">', '</span></div>' );
		endif;

		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>
	
	<?php nightly_entry_footer(); ?>

</article><!-- #post-## -->

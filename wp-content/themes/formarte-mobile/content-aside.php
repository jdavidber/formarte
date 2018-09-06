<?php
/**
 * The default template for displaying aside content
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("item"); ?>>

<?php // check if the post has a Post Thumbnail assigned to it.
if ( has_post_thumbnail() ) {
		the_post_thumbnail('category-thumb', array('class' => 'fullwidth'));
} ?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h2>', '</h2>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content blog-prologue">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	
	<?php if ( is_single() ) :
	
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'nightly-mobile' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'nightly-mobile' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
	
		the_tags( '<div>Tagged in <span class="ui-tag" data-theme="'. get_option("nightly_theme").'">', '</span><span class="ui-tag" data-theme="'. get_option("nightly_theme").'">', '</span></div>' );
		endif;

		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<?php nightly_entry_footer(); ?>

</article><!-- #post-## -->

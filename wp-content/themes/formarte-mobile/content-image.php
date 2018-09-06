<?php
/**
 * The default template for displaying images content.
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("item entry-image-post"); ?>>

	<header class="entry-header">
		<div class="entry-inner">
			<?php the_title( '<h2>', '</h2>' ); ?>
			<?php nightly_entry_meta(); ?>
		</div>
		
		<?php // check if the post has a Post Thumbnail assigned to it.
		if ( has_post_thumbnail() ) {
			if ( is_single() ) {
				the_post_thumbnail('category-thumb', array('class' => 'fullwidth'));		
			} else {
				printf( '<a href="%s" rel="bookmark" class="entry-image-post-thumbnail">', esc_url( get_permalink() ) );
				the_post_thumbnail('category-thumb', array('class' => 'fullwidth'));
				printf( '</a>' );
			}
		} ?>
	</header><!-- .entry-header -->
	
	<?php if ( is_single() ) : ?>

		<?php $categories_list = get_the_category_list();
		if ( $categories_list && ( is_single() || has_post_thumbnail() ) ) {
			echo '<span class="categories-links" data-theme="'. get_option("nightly_theme").'">' . $categories_list . '</span>';
		} ?>
		
		<div class="entry-content blog-prologue">
			<?php
				/* translators: %s: Name of current post */
	
				if( !is_single() ) {
					echo nightly_content(30);
				} else {
					the_content();
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'nightly-mobile' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'nightly-mobile' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
				}

			?>
		</div><!-- .entry-content -->
	
		<?php 
		
		the_tags( '<div>Tagged in <span class="ui-tag" data-theme="'. get_option("nightly_theme_theme").'">', '</span><span class="ui-tag" data-theme="'. get_option("nightly_theme").'">', '</span></div>' );
		endif;

		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' ); ?>

		<?php nightly_entry_footer(); ?>
	
	<?php endif; // is_single() ?>

</article><!-- #post-## -->

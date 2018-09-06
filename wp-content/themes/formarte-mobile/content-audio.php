<?php
/**
 * The default template for displaying audio posts
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("item entry-audio-post"); ?>>

<?php $audio_url = get_post_meta($post->ID, 'link', true); ?>

<div class="audio-wrapper">

	<?php if ( strpos( $audio_url, 'soundcloud.com') === false ) : ?>
	
		<audio controls="controls" class="audio-player">
			<source src="<?php echo esc_attr ( $audio_url ); ?>" />
		</audio>
	
	<?php else: ?>
	
		<?php echo wp_oembed_get( $audio_url, array( 'height' => 166 ) );?>
	
	<?php endif; ?>
</div>
 
<?php if( strlen( get_the_title() ) != 0 ): ?>

	<?php $categories_list = get_the_category_list();
	if ( $categories_list ) {
		echo '<span class="categories-links" data-theme="'. get_option("nightly_theme").'">' . $categories_list . '</span>';
	} ?>
	
	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h2>', '</h2>' );
			else :
				the_title( sprintf( '<a href="%s" rel="bookmark"><h2>', esc_url( get_permalink() ) ), '</h2></a>' );
			endif;
		?>
	</header><!-- .entry-header -->
	
	<?php nightly_entry_meta(); ?>

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
	
	<?php if ( is_single() ) :
	
		the_tags( '<div>Tagged in <span class="ui-tag" data-theme="'. get_option("nightly_theme").'">', '</span><span class="ui-tag" data-theme="'. get_option("nightly_theme").'">', '</span></div>' );
		endif;

		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<?php nightly_entry_footer(); ?>
	
	<?php endif; ?>
	
</article><!-- #post-## -->

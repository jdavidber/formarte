<?php
/**
 * The default template for displaying excerpt posts
 *
 * Used for both single and index/archive/search
 * Active only if enabled Excerpt blog style
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */

 $nightly_blog_post_excerpt = html_entity_decode( nightly_global('nightly_blog_post_excerpt') );
 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("item"); ?>>

<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
	<div class="post-thumbnail">
		<?php if ( has_post_thumbnail() ) {
			if ( is_single() ) {
				the_post_thumbnail('category-thumb', array('class' => 'small'));		
			} else {
				printf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) );
				the_post_thumbnail('category-thumb', array('class' => 'small'));
				printf( '</a>' );
			}
		} ?>
	</div>
<?php endif; ?>

<div class="entry-content-block">

	<header class="entry-header">
		<div class="blog-date-meta">
			<?php nightly_excerpt_entry_date(); ?>
			<?php if ( !is_single() ): ?>
				<div class="wrapper blog-author-link">
					<?php echo nightly_excerpt_author_posts_link(); ?>
				</div>
			<?php endif; ?>
		</div>
		
		<?php
			if ( is_single() ) :
				the_title( '<h2>', '</h2>' );
			else :
				the_title( sprintf( '<a href="%s" rel="bookmark"><h2>', esc_url( get_permalink() ) ), '</h2></a>' );
			endif;
		?>
	</header><!-- .entry-header -->
	
	<?php 
		if ( ( $nightly_blog_post_excerpt == 0 ) || ( get_the_excerpt() == "" ) ) :
		else : ?>
		
	<div class="entry-content">
	
			<?php 
				if( ! is_single() ) {
					the_excerpt();
				} else {
				
					/* translators: %s: Name of current post */
					the_content( sprintf(
						esc_html__( 'Continue reading %s', 'nightly-mobile' ),
						the_title( '<span class="screen-reader-text">', '</span>', false )
					) );	
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
	<?php endif; ?>
	
</div><!-- .entry-content-block -->

</article><!-- #post-## -->

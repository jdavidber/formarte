<?php
/**
 * The default template for displaying excerpt posts
 *
 * Used only for page-blog-feed.
 * This post type is super fast for great amounts of posts
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("item"); ?>>

	<header class="entry-header">
		<?php the_title( sprintf( '<a href="%s" rel="bookmark"><h2>', esc_url( get_permalink() ) ), '</h2></a>' ); ?>
	</header><!-- .entry-header -->
		
	<div class="entry-content">
	
	</div><!-- .entry-content -->
	
	<div class="entry-footer">
		<?php echo nightly_excerpt_author_posts_link(); ?>
		<span class="post-date">
			<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
		</span>
	</div><!-- .entry-footer -->

</article><!-- #post-## -->

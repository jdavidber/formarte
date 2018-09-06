<?php
/**
 * The default template for no content
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("item"); ?>>

	<header class="entry-header">
		<h2><?php esc_html__('Nothing found', 'nightly-mobile'); ?></h2>
	</header><!-- .entry-header -->

	<div class="entry-content blog-prologue">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		
					<p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'nightly-mobile' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		
				<?php elseif ( is_search() ) : ?>
		
					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'nightly-mobile' ); ?></p>
					<?php get_search_form(); ?>
		
				<?php else : ?>
		
					<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'nightly-mobile' ); ?></p>
					<?php get_search_form(); ?>
		
				<?php endif; ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

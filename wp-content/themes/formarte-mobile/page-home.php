<?php
/**
 * Template Name: Page – Homepage
 * Description: Custom home page with Owl Carousel
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */
 
get_header(); ?>

<?php if ( function_exists( 'luke_slider' ) ) {
	luke_slider();
} ?>

		<?php
		
		while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class("item"); ?>>
			
					<div class="entry-content blog-prologue">
						
						<?php the_content(); ?>
						
					</div><!-- .entry-content -->
				
				</article><!-- #post-## -->

			<?php // If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>

<?php get_footer(); ?>
<?php
/**
 * The default template for displaying page content.
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
			<?php the_title( '<h2>', '</h2>' ); ?>
		</header><!-- .entry-header -->
		
		<div class="entry-content blog-prologue">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
		
</article><!-- #post-## -->

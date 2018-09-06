<?php
/**
 * Template Name: Page – Navigation (boxes)
 * Description: Page that can be used as navigation. Box icons
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */
 
get_header(); ?>

	<?php // check if the post has a Post Thumbnail assigned to it and set it as background
	if ( has_post_thumbnail() ) : ?>
	<div class="nightly-navigation-page-background">
		<?php the_post_thumbnail( 'category-thumb', array ( 'class' => 'fullwidth' ) ); ?>
	</div>
	<?php endif; ?>

	<ul data-role="listview" class="nightly-page-navigation navi-boxes">
		<?php wp_nav_menu( array(
	    'menu'            => 'mobile-menu',
	    'theme_location'  => 'nightly-navigation-page',
	    'container'       => false,
	    'items_wrap'      => '<ul data-role="listview">%3$s</ul>' )
	    ); ?>
	</ul>

<?php get_footer(); ?>
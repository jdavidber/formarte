<?php
/**
 * Template Name: Page – Navigation (circles)
 * Description: Page that can be used as navigation. Circle icons
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */
 
get_header(); ?>

	<?php if ( nightly_global('nightly_custom_header_logo') == true ) { ?>
	    <div class="header-logo">
	        <img src="<?php echo esc_url ( nightly_global('nightly_header_logo') ); ?>" alt="<?php echo bloginfo( 'name' ); ?>" />
	      </div>
	<?php } else { ?>
		<h1 class="header-title">
		<?php if ( nightly_global('nightly_custom_header_title') == true ) {
			echo html_entity_decode ( esc_html (  nightly_global('nightly_header_title') ) );
		} else {
			bloginfo( 'name' );
		} ?>
		</h1>
	<?php } ?>

	<?php // check if the post has a Post Thumbnail assigned to it and set it as background
	if ( has_post_thumbnail() ) : ?>
	<div class="nightly-navigation-page-background">
		<?php the_post_thumbnail( 'category-thumb', array ( 'class' => 'fullwidth' ) ); ?>
	</div>
	<?php endif; ?>

	<ul data-role="listview" class="nightly-page-navigation navi-circles">
		<?php wp_nav_menu( array(
	    'menu'            => 'mobile-menu',
	    'theme_location'  => 'nightly-navigation-page',
	    'container'       => false,
	    'items_wrap'      => '<ul data-role="listview">%3$s</ul>' )
	    ); ?>
	</ul>

<?php get_footer(); ?>
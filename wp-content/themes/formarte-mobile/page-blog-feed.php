<?php
/**
 * Template Name: Blog – Feed
 * Description: Custom blog page for blog feed style
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */

get_header();

$counter = 1;

$nightly_ad = html_entity_decode( nightly_global('nightly_ad') );
$nightly_ad_post_num = html_entity_decode( nightly_global('nightly_ad_post_num') );
$nightly_ad_text = html_entity_decode( nightly_global('nightly_ad_text') );

if ( nightly_global('nightly_blog_style') != "" ) {
	$nightly_blog_style = html_entity_decode( nightly_global('nightly_blog_style') );
} else {
	$nightly_blog_style = "normal";
}

?>

<?php 

$nPosts = 20; // number of posts per page. Change to any number needed.
$customPageTitle = get_the_title(); // Page title

query_posts('post_type=post&post_status=publish&posts_per_page='.$nPosts.'&paged='. get_query_var('paged')); ?>

	<?php if ( have_posts() ) : ?>
		
		<div class="blog feed">
		
			<h2 class="page-title"><?php echo esc_html( $customPageTitle ); ?></h2>
			
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'feed' ); ?>
				<?php if ( $nightly_ad_post_num != 0 && ( $counter % $nightly_ad_post_num == 0 ) ): ?>
					<?php if ( $nightly_ad_text != "" && $nightly_ad ) : ?>
					  <section class="ad-post-area">
								<?php echo html_entity_decode ( esc_html ( $nightly_ad_text ) ); ?>
						</section> <!-- #ad-post-area -->
					<?php endif; ?>
				<?php endif; ?>
				<?php $counter++; //increment by 1 ?>
			<?php endwhile; ?>

			<div id="page-nav" class="wrapper">
      	<?php 
            previous_posts_link('<span class="page-nav-prev">&#x27f5; '.esc_html__( 'Previous', 'nightly-mobile' ).'</span>');
            next_posts_link('<span class="page-nav-next">'.esc_html__( 'Next', 'nightly-mobile' ).' &#x27f6;</span>');
      	?>
      </div>

	    <?php else : get_template_part( 'content', 'none' ); endif;
			wp_reset_postdata(); ?>
	</div>

<?php get_footer(); ?>
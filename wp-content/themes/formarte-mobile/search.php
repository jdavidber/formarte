<?php
/**
 * The template for displaying search results pages.
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

$qSearch = new WP_Query("s=$s & showposts=-1");
$nSearch = $qSearch->post_count;

?>
	
		<div class='nightly-alert nightly-alert-info entry-search-alert<?php if( ($nightly_blog_style == "excerpt")  && !is_single() ) echo " excerpt" ?>'>
			<i class='fa fa-2x fa-lightbulb-o fa-fw'></i>
			<p><?php printf( esc_html__( 'Search results (%s) for %s', 'nightly-mobile' ), $nSearch, get_search_query() ); ?></p>
		</div>
	
		<?php if ( have_posts() ) : ?>
		
		<div class="blog<?php if( ( $nightly_blog_style == "excerpt" )  && ! is_single() ) echo " excerpt" ?>">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if ( $nightly_blog_style == "normal" ) {
						get_template_part( 'content', get_post_format() );
				} else {
					if( ( $nightly_blog_style == "excerpt" ) && !is_single() ) {
						get_template_part( 'content', 'excerpt' );
					} else {
						get_template_part( 'content', get_post_format() );
					}
				} ?>
				<?php if ( $nightly_ad_post_num != 0 && ( $counter % $nightly_ad_post_num == 0 ) ): ?>
					<?php if ( $nightly_ad_text != "" ) : ?>
					  <section class="ad-post-area">
								<?php echo esc_html ( $nightly_ad_text ); ?>
						</section> <!-- #ad-post-area -->
					<?php endif; ?>
				<?php endif; ?>
				<?php $counter++; //increment by 1 ?>
			<?php endwhile; ?>

			  <div id="page-nav" class="wrapper">
            <?php posts_nav_link(); ?>
        </div>

        <?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>
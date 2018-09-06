<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */

get_header();

$counter = 1; 
$nightly_ad_text = html_entity_decode( nightly_global('nightly_ad_text') );
$nightly_ad_post_num = html_entity_decode( nightly_global('nightly_ad_post_num') );
$nightly_blog_style = nightly_global('nightly_blog_style');

?>
		
		<?php
			the_archive_title( '<div class="nightly-alert nightly-alert-info entry-search-alert">
				<i class="fa fa-2x fa-lightbulb-o fa-fw"></i>
				<p>Posts for ', '</p></div>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
	
		<?php if ( have_posts() ) : ?>
		
		<div class="blog<?php if( ( $nightly_blog_style == "excerpt" )  && !is_single() ) echo " excerpt" ?>">
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
								<?php echo esc_html( $nightly_ad_text ); ?>
						</section> <!-- #ad-post-area -->
					<?php endif; ?>
				<?php endif; ?>
				<?php $counter++; //increment by 1 ?>
			<?php endwhile; ?>

			  <div id="page-nav" class="wrapper">
			      <?php 
			      	the_posts_pagination( array(
			      		'prev_text'          => '<span class="page-nav-prev">&#x27f5; '.esc_html__( 'Previous page', 'nightly-mobile' ).'</span>',
			      		'next_text'          => '<span class="page-nav-next">'.esc_html__( 'Next page', 'nightly-mobile' ).' &#x27f6;</span>',
			      		'before_page_number' => '',
			      		'screen_reader_text' => ''
			      	) );
			       ?>
			  </div>

        <?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>
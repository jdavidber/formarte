<?php $sidebar = oxides_edge_sidebar_layout(); ?>
<?php get_header(); ?>
<?php 
global $wp_query;

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

if(oxides_edge_options()->getOptionValue('blog_page_range') != ""){
	$blog_page_range = esc_attr(oxides_edge_options()->getOptionValue('blog_page_range'));
} else{
	$blog_page_range = $wp_query->max_num_pages;
}
?>
<?php get_template_part( 'title' ); ?>
	<div class="edgtf-container">
		<?php do_action('oxides_edge_after_container_open'); ?>
		<div class="edgtf-container-inner clearfix">
			<div class="edgtf-container">
				<?php do_action('oxides_edge_after_container_open'); ?>
				<div class="edgtf-container-inner" >
					<div class="edgtf-blog-holder edgtf-blog-type-standard">
				<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="edgtf-post-content">
							<div class="edgtf-post-text">
								<div class="edgtf-post-text-inner">
									<h2>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</h2>
                                    <div class="edgtf-post-read-more-holder">
                                        <?php oxides_edge_read_more_button();	?>
                                    </div>
                                    <div class="edgtf-post-info">
                                        <?php if ( has_post_thumbnail() ) {
                                            oxides_edge_post_info(array('comments' => 'yes', 'like' => 'yes', 'share' => 'yes'));
                                        } else {
                                            oxides_edge_post_info(array('date' => 'yes', 'comments' => 'yes', 'like' => 'yes', 'share' => 'yes'));
                                        } ?>
                                    </div>
								</div>
							</div>
						</div>
					</article>
					<?php endwhile; ?>
					<?php
						if(oxides_edge_options()->getOptionValue('pagination') == 'yes') {
							oxides_edge_pagination($wp_query->max_num_pages, $blog_page_range, $paged);
						}
					?>
					<?php else: ?>
					<div class="entry">
						<p><?php esc_html_e('No posts were found.', 'oxides'); ?></p>
					</div>
					<?php endif; ?>
				</div>
				<?php do_action('oxides_edge_before_container_close'); ?>
			</div>
			</div>
		</div>
		<?php do_action('oxides_edge_before_container_close'); ?>
	</div>
<?php get_footer(); ?>
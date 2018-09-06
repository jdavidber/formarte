<?php
	$blog_list_category = 'yes';
	if(oxides_edge_options()->getOptionValue('blog_list_category') == 'no') {
		$blog_list_category = 'no';
	}
	$blog_list_comments = 'yes';
	if(oxides_edge_options()->getOptionValue('blog_list_comments') == 'no') {
		$blog_list_comments = 'no';
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="edgtf-post-image clearfix">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('full'); ?>

					<div class="edgtf-post-triangle-holder">
						<div class="edgtf-post-triangle"></div>
					</div>
				</a>
			</div>
		<?php } ?>
		<div class="edgtf-post-text-holder">
			<div class="edgtf-post-text-inner">
				<div class="edgtf-post-info">
					<?php oxides_edge_post_info(array('date' => 'yes', 'category' => $blog_list_category, 'comments' => $blog_list_comments)) ?>
				</div>

				<?php oxides_edge_get_module_template_part('templates/lists/parts/title', 'blog', 'checkered'); ?>
				
				<?php oxides_edge_excerpt($excerpt_length); ?>
				
				<div class="edgtf-post-read-more-holder">
					<a class="edgtf-read-more-button" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html_e('READ MORE', 'oxides'); ?><span class="arrow_right"></span></a>
				</div>
			</div>	
		</div>	
	</div>	
</article>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<?php oxides_edge_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
		<?php oxides_edge_get_module_template_part('templates/parts/audio', 'blog'); ?>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner clearfix">
				<?php oxides_edge_get_module_template_part('templates/single/parts/title', 'blog'); ?>

				<?php the_content(); ?>

				<div class="edgtf-post-info">
					<?php if ( has_post_thumbnail() ) {
						oxides_edge_post_info(array('comments' => 'yes', 'like' => 'yes', 'category' => 'yes', 'share' => 'yes'));
					} else {
						oxides_edge_post_info(array('date' => 'yes', 'comments' => 'yes', 'like' => 'yes', 'category' => 'yes', 'share' => 'yes'));
					} ?>
				</div>
			</div>
		</div>
	</div>
	<?php do_action('oxides_edge_before_blog_article_closed_tag'); ?>
</article>
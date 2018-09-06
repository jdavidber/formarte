<?php
	$month = 'M';
	$day = 'd';
	$year = 'Y';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<div class="edgtf-post-image">
			<?php oxides_edge_get_module_template_part('templates/parts/video', 'blog'); ?>

			<span class="edgtf-post-date-holder">
				<span class="edgtf-post-month-day">
					<span class="edgtf-post-month"><?php the_time($month); ?></span>
					<span class="edgtf-post-day"><?php the_time($day); ?></span>
				</span>	
				<span class="edgtf-post-year"><?php the_time($year); ?></span>
			</span>
		</div>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner clearfix">
				<?php oxides_edge_get_module_template_part('templates/single/parts/title', 'blog'); ?>

				<?php the_content(); ?>

				<div class="edgtf-post-info">
					<?php oxides_edge_post_info(array('comments' => 'yes', 'like' => 'yes', 'category' => 'yes', 'share' => 'yes')); ?>
				</div>
			</div>
		</div>
	</div>
	<?php do_action('oxides_edge_before_blog_article_closed_tag'); ?>
</article>
<?php
	$month = 'M';
	$day = 'd';
	$year = 'Y';

	$blog_list_category = 'yes';
	if(oxides_edge_options()->getOptionValue('blog_list_category') == 'no') {
		$blog_list_category = 'no';
	}
	$blog_list_comments = 'yes';
	if(oxides_edge_options()->getOptionValue('blog_list_comments') == 'no') {
		$blog_list_comments = 'no';
	}
	$blog_list_like = 'yes';
	if(oxides_edge_options()->getOptionValue('blog_list_like') == 'no') {
		$blog_list_like = 'no';
	}
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
			<div class="edgtf-post-text-inner">
				<?php oxides_edge_get_module_template_part('templates/lists/parts/title', 'blog'); ?>

				<?php
					the_content();
				?>

				<div class="edgtf-post-info">
					<?php oxides_edge_post_info(array('category' => $blog_list_category, 'comments' => $blog_list_comments, 'like' => $blog_list_like, 'share' => 'yes')); ?>
				</div>
			</div>
		</div>
	</div>
</article>
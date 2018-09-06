<?php
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
		<?php oxides_edge_get_module_template_part('templates/lists/parts/gallery', 'blog'); ?>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<?php oxides_edge_get_module_template_part('templates/lists/parts/title', 'blog'); ?>

				<?php oxides_edge_excerpt($excerpt_length); ?>
				
				<div class="edgtf-post-read-more-holder">
					<?php oxides_edge_read_more_button();	?>
				</div>

				<div class="edgtf-post-info">
					<?php if ( has_post_thumbnail() ) {
						oxides_edge_post_info(array('category' => $blog_list_category, 'comments' => $blog_list_comments, 'like' => $blog_list_like, 'share' => 'yes'));
					} else {
						oxides_edge_post_info(array('category' => $blog_list_category, 'date' => 'yes', 'comments' => $blog_list_comments, 'like' => $blog_list_like, 'share' => 'yes'));
					} ?>
				</div>
			</div>
		</div>
	</div>
</article>
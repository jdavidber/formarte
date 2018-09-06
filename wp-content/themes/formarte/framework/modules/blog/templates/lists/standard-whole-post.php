<div class="edgtf-blog-holder edgtf-blog-type-standard">
	<?php
		if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			oxides_edge_get_post_format_html($blog_type);
		endwhile;
		else:
			oxides_edge_get_module_template_part('templates/parts/no-posts', 'blog');
		endif;
	?>
</div>
<?php
	if(oxides_edge_options()->getOptionValue('pagination') == 'yes') {
		oxides_edge_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
	}
?>
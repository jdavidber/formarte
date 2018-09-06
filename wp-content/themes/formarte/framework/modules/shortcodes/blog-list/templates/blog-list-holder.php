<div class="edgtf-blog-list-holder <?php echo esc_attr($holder_classes) ?>">
	<ul class="edgtf-blog-list">
	<?php 
		$html = '';
		
		if($query_result->have_posts()):
			while ($query_result->have_posts()) : $query_result->the_post();
				$html .= oxides_edge_get_shortcode_module_template_part('templates/'.$type, 'blog-list', '', $params);
			endwhile;
			print $html;
		else: ?>
			<div class="edgtf-blog-list-messsage">
				<p><?php esc_html_e('No posts were found.', 'oxides'); ?></p>
			</div>
		<?php endif;
		wp_reset_postdata();
	?>
	</ul>	
</div>

<div class="edgtf-progress-bar">
	<<?php echo esc_attr($title_tag);?> class="edgtf-progress-title-holder clearfix">
		<span class="edgtf-progress-title" <?php echo oxides_edge_get_inline_style($title_styles); ?>><?php echo esc_attr($title)?></span>
		<span class="edgtf-progress-number-wrapper <?php echo esc_attr($percentage_classes)?> " >
			<span class="edgtf-progress-number" <?php echo oxides_edge_get_inline_style($progress_bar_number_styles); ?>>
				<span class="edgtf-percent">0</span>	
				<span class="edgtf-down-arrow" <?php echo oxides_edge_get_inline_style($progress_bar_arrow_styles); ?>></span>
			</span>
		</span>
	</<?php echo esc_attr($title_tag)?>>
	<div class="edgtf-progress-content-outer" <?php echo oxides_edge_get_inline_style($progress_bar_inactive_styles); ?>>
		<div data-percentage=<?php echo esc_attr($percent)?> class="edgtf-progress-content" <?php echo oxides_edge_get_inline_style($progress_bar_active_styles); ?>></div>
	</div>
</div>	
<?php
/**
 * Pie Chart Basic Shortcode Template
 */
?>
<div class="edgtf-pie-chart-holder <?php echo esc_attr($pie_chart_classes)?>">
	<div class="edgtf-percentage" <?php echo oxides_edge_get_inline_attrs($pie_chart_data); ?>>
		<span class="edgtf-to-counter" <?php echo oxides_edge_get_inline_style($percent_styles); ?>>
			<span class="edgtf-to-counter-inner">
				<?php echo esc_html($percent); ?>
			</span>	
		</span>
	</div>
	<div class="edgtf-pie-chart-text" <?php echo oxides_edge_get_inline_style($text_area_styles); ?>>
		<?php if ($title !== "") { ?>
			<<?php echo esc_attr($title_tag); ?> class="edgtf-pie-title" <?php echo oxides_edge_get_inline_style($title_styles); ?>>
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
			
		<?php if ($text !== "") { ?>
			<p <?php echo oxides_edge_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
			
		<?php if ($separator === "yes") { ?>
			<span class="edgtf-pie-chart-separator" <?php echo oxides_edge_get_inline_style($separator_styles); ?>></span>
		<?php } ?>
	</div>
</div>
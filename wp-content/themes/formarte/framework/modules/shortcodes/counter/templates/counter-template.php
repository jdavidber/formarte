<?php
/**
 * Counter shortcode template
 */
?>
<div class="edgtf-counter-holder <?php echo esc_attr($counter_type); ?> <?php if($counter_type == "standard") { echo esc_attr($counter_position); } ?> <?php echo esc_attr($elements_position); ?> clearfix">
		
	<?php if(($counter_type == "standard" && $counter_position == "left_counter") || $counter_type == "with_icon"){ ?> <!-- This condition is for tabel cell layout to split elements into two coulmns -->
		<div class="edgtf-counter-outer">
			<div class="edgtf-counter-inner1" <?php echo oxides_edge_get_inline_style($column_one_proportion_styles); ?>>
	<?php } ?>

	<?php if($counter_type == "with_icon"){ ?> <!-- Close table cell column 1 and open column 2 html tag for icon counter type-->
			
				<?php echo oxides_edge_icon_collections()->renderIcon($icon, $icon_pack, $icon_params); ?>

			</div>
			<div class="edgtf-counter-inner2" <?php echo oxides_edge_get_inline_style($column_two_proportion_styles); ?>>
	<?php } ?>
			
			<?php if ($digit != "") { ?>
				<span class="edgtf-counter" <?php echo oxides_edge_get_inline_style($counter_styles); ?> data-decimals-value="<?php echo esc_attr($decimals_value); ?>">
					<?php echo esc_attr($digit); ?>
				</span>
			<?php } ?>	

	<?php if($counter_type == "standard" && $counter_position == "left_counter"){ ?> <!-- Close table cell column 1 and open column 2 html tag -->
			</div>
			<div class="edgtf-counter-inner2" <?php echo oxides_edge_get_inline_style($column_two_proportion_styles); ?>>
	<?php } ?>

			<?php if ($title != "") { ?>
				<<?php echo esc_html($title_tag); ?> class="edgtf-counter-title" <?php echo oxides_edge_get_inline_style($title_styles); ?>>
					<?php echo esc_attr($title); ?>
				</<?php echo esc_html($title_tag);; ?>>
			<?php } ?>

			<?php if ($text != "") { ?>
				<p class="edgtf-counter-text" <?php echo oxides_edge_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
			<?php } ?>

			<?php if ($counter_position != "left_counter" && $counter_type != "with_icon") { ?>
				<span class="edgtf-counter-separator" <?php echo oxides_edge_get_inline_style($separator_styles); ?>></span>
			<?php } ?>

	<?php if(($counter_type == "standard" && $counter_position == "left_counter") || $counter_type == "with_icon"){ ?> <!-- Column 2 and table close div -->
			</div>
		</div>
	<?php } ?>			
</div>
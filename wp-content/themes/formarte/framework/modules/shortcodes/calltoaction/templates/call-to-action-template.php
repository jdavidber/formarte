<?php
/**
 * Call to action shortcode template
 */
?>

<?php if ($full_width == "no") { ?>
	<div class="edgtf-container-inner">
<?php } ?>

	<div class="edgtf-call-to-action <?php echo esc_attr($type); ?>" <?php echo oxides_edge_get_inline_style($call_to_action_styles); ?>>

		<?php if ($content_in_grid == 'yes' && $full_width == 'yes') { ?>
		<div class="edgtf-container-inner">
		<?php }

		if ($grid_size == "75") { ?>
			<div class="edgtf-call-to-action-row-75-25 clearfix" <?php echo oxides_edge_get_inline_style($call_to_action_inner_styles); ?>>
		<?php } elseif ($grid_size == "66") { ?>
			<div class="edgtf-call-to-action-row-66-33 clearfix" <?php echo oxides_edge_get_inline_style($call_to_action_inner_styles); ?>>
		<?php } elseif ($grid_size == "80") { ?>
			<div class="edgtf-call-to-action-row-80-20 clearfix" <?php echo oxides_edge_get_inline_style($call_to_action_inner_styles); ?>>
		<?php } else { ?>
			<div class="edgtf-call-to-action-row-50-50 clearfix" <?php echo oxides_edge_get_inline_style($call_to_action_inner_styles); ?>>
		<?php } ?>

				<div class="edgtf-text-wrapper <?php echo esc_attr($text_wrapper_classes) ?>">

				<?php if ($type == "with-icon") { ?>
					<div class="edgtf-call-to-action-icon-holder">
						<div class="edgtf-call-to-action-icon">
							<div class="edgtf-call-to-action-icon-inner">
								<?php print $icon; ?>
							</div>
						</div>
					</div>
				<?php } ?>

					<div class="edgtf-call-to-action-text" <?php echo oxides_edge_get_inline_style($content_styles); ?>>
						<div class="edgtf-call-to-action-text-inner" <?php echo oxides_edge_get_inline_style($icon_separator_styles); ?>>
							<?php
							echo do_shortcode($content);
							?>
						</div>
					</div>

				</div>

				<?php if ($show_button == 'yes') { ?>

					<div class="edgtf-button-wrapper edgtf-call-to-action-column2 edgtf-call-to-action-cell" style ="text-align: <?php echo esc_attr($button_position) ?> ;">

						<?php echo oxides_edge_get_button_html($button_parameters); ?>

					</div>

				<?php } ?>

			</div>

		<?php if ($content_in_grid == 'yes' && $full_width == 'yes') { ?>
		</div>
		<?php } ?>

	</div>

<?php if ($full_width == 'no') { ?>
	</div>
<?php } ?>
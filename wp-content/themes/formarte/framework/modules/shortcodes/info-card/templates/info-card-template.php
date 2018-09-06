<div class="edgtf-info-card-holder clearfix" <?php echo oxides_edge_get_inline_style($content_styles); ?>>
	<div class="edgtf-info-card-initial" <?php echo oxides_edge_get_inline_style($content_initial_styles); ?>>
		<div class="edgtf-info-card-inner">
			<?php print $icon_initial_params; ?>

			<?php if ($initial_title != "") { ?>
				<h6 class="edgtf-info-card-title edgtf-info-card-initial-title" <?php echo oxides_edge_get_inline_style($title_initial_styles); ?>>
					<?php echo esc_attr($initial_title); ?>
				</h6>
			<?php } ?>

			<?php if($initial_separator === 'yes'){ ?>
				<span class="edgtf-info-card-separator edgtf-info-card-initial-separator" <?php echo oxides_edge_get_inline_style($separator_initial_styles); ?>></span>
			<?php } ?>	

			<?php if ($initial_text != "") { ?>
				<p class="edgtf-info-card-text edgtf-info-card-initial-text" <?php echo oxides_edge_get_inline_style($text_initial_styles); ?>><?php echo esc_html($initial_text); ?></p>
			<?php } ?>
		</div>	
	</div>
	<div class="edgtf-info-card-hover" <?php echo oxides_edge_get_inline_style($content_hover_styles); ?>>
		<div class="edgtf-info-card-inner">
			<?php print $icon_hover_params; ?>

			<?php if ($hover_title != "") { ?>
				<h6 class="edgtf-info-card-title edgtf-info-card-hover-title" <?php echo oxides_edge_get_inline_style($title_hover_styles); ?>>
					<?php echo esc_attr($hover_title); ?>
				</h6>
			<?php } ?>

			<?php if($hover_separator === 'yes'){ ?>
				<span class="edgtf-info-card-separator edgtf-info-card-hover-separator" <?php echo oxides_edge_get_inline_style($separator_hover_styles); ?>></span>
			<?php } ?>	

			<?php if ($hover_text != "") { ?>
				<p class="edgtf-info-card-text edgtf-info-card-hover-text" <?php echo oxides_edge_get_inline_style($text_hover_styles); ?>><?php echo esc_html($hover_text); ?></p>
			<?php } ?>
		</div>
	</div>
	<?php if($link !== '') : ?>
        <a class="edgtf-info-card-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
    <?php endif; ?>
</div>
<div class="edgtf-tabs <?php echo esc_attr($tab_class); ?> <?php echo esc_attr($tab_title_layout); ?> clearfix">
	<?php if($tab_area_title !== '' && $tab_class === 'edgtf-horizontal-tab edgtf-full-width-tab') { ?>
	<div class="edgtf-tabs-title">
		<h3 <?php echo oxides_edge_get_inline_style($tab_title_styles); ?>><?php echo esc_attr($tab_area_title); ?></h3>
	</div>
	<?php } ?>
	<ul class="edgtf-tabs-nav">
		<?php  foreach ($tabs_titles as $tab_title) {?>
			<li>
				<a class="<?php echo esc_attr($title_class); ?>" href="#tab-<?php echo sanitize_title($tab_title)?>" <?php echo oxides_edge_get_inline_style($title_styles); ?>>
					<?php if(($tab_class === 'edgtf-vertical-tab' || $tab_class === 'edgtf-horizontal-tab edgtf-full-width-tab') && ($tab_title_layout === 'edgtf-tab-with-icon' || $tab_title_layout === 'edgtf-tab-only-icon')) { ?>
						<span class="edgtf-icon-frame"></span>

						<?php if($tab_class === 'edgtf-horizontal-tab edgtf-full-width-tab') { ?>
							<span class="edgtf-tab-title-separator"></span>
						<?php } ?>
					<?php } ?>

					<?php if($tab_title !== '' && $tab_title_layout !== 'edgtf-tab-only-icon') { ?>
						<span class="edgtf-tab-text-after-icon">
							<?php echo esc_attr($tab_title)?>
						</span>
					<?php } ?>
						
					<?php if($tab_class !== 'edgtf-vertical-tab' && $tab_class !== 'edgtf-horizontal-tab edgtf-full-width-tab' && ($tab_title_layout === 'edgtf-tab-with-icon' || $tab_title_layout === 'edgtf-tab-only-icon')) { ?>
						<span class="edgtf-icon-frame"></span>
					<?php } ?>
					
					<?php if($tab_class !== 'edgtf-horizontal-tab edgtf-full-width-tab') { ?>
					<span class="edgtf-tab-title-separator"></span>
					<?php } ?>
				</a>
			 </li>
		<?php } ?>
	</ul> 
	<?php echo do_shortcode($content) ?>
</div>
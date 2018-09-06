<div class="edgtf-price-table <?php echo esc_attr($pricing_table_classes); ?>">
	<div class="edgtf-price-table-inner">
		<ul>
			<li class="edgtf-table-prices">
				<div class="edgtf-price-in-table">
					<sup class="edgtf-value"><?php echo esc_attr($currency) ?></sup>
					<span class="edgtf-price"><?php echo esc_attr($price)?></span>
					<span class="edgtf-mark"><?php echo esc_attr($price_period)?></span>
				</div>	
			</li>
			<?php if($title !== ''){ ?>
				<li class="edgtf-table-title">
					<h6 class="edgtf-title-content"><?php echo esc_html($title) ?></h6>

					<?php if($title_separator === 'yes'){ ?>
						<span class="edgtf-price-title-separator"></span>
					<?php } ?>
				</li>
			<?php } ?>		
			<li class="edgtf-table-content">
				<?php echo do_shortcode($content)?>
			</li>
			<?php 
			if($show_button == "yes" && $button_text !== ''){ ?>
				<li class="edgtf-price-button">
					<?php echo oxides_edge_get_button_html(array(
						'link' => $link,
						'text' => $button_text
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>

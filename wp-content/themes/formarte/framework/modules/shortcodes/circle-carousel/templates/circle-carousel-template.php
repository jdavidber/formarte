<div class="edgtf-circle-carousel" <?php echo oxides_edge_get_inline_attrs($slider_data); ?>>
	<div class="edgtf-circle-carousel-slider">
		<?php foreach ($images as $image) { ?>
			<img src="<?php echo esc_url($image['url'])?>" alt="<?php echo esc_attr($image['title']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>">
		<?php } ?>
	</div>

	<div class="edgtf-circle-carousel-navigation clearfix">
		<div class="edgtf-prev-icon-holder">
			<div class="edgtf-icon-inner">
				<a class="edgtf-circle-carousel-icon arrow_left" href="#" target="_self"></a>
				<span class="edgtf-navigation-counter"></span>
			</div>	
		</div>
        <div class="edgtf-next-icon-holder">
        	<div class="edgtf-icon-inner">	
        		<span class="edgtf-navigation-counter"></span>
        		<a class="edgtf-circle-carousel-icon arrow_right" href="#" target="_self"></a>
        	</div>	
		</div>
	</div>
</div>
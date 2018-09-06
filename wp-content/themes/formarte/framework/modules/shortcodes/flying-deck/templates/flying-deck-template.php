<div class="edgtf-flying-deck">
	<div class="edgtf-flying-deck-inner">
		<?php $i=-1; foreach ($images as $image) { $i++; ?>
			<div class="edgtf-fd-img">
				<div class="edgtf-fd-y-spin">
					<div class="edgtf-fd-x-spin">
						<div class="edgtf-fd-y2-spin">
							<div class="edgtf-fd-x2-spin">
								<?php if(isset($custom_links[$i]) && $custom_links[$i] !== '') { ?>
								<a href="<?php echo esc_url($custom_links[$i]); ?>" target="<?php echo esc_attr($custom_links_target); ?>">
								<?php } ?>
									<img src="<?php echo esc_url($image['url'])?>" alt="<?php echo esc_attr($image['title']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>">
								<?php if(isset($custom_links[$i]) && $custom_links[$i] !== '') { ?>
								</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
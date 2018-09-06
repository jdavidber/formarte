<div id="edgtf-testimonials<?php echo esc_attr($current_id) ?>" class="edgtf-testimonial-content">
	<?php if (has_post_thumbnail($current_id)) { ?>
		<div class="edgtf-testimonial-image-holder">
			<?php esc_html(the_post_thumbnail($current_id)) ?>
		</div>
	<?php } ?>
	<div class="edgtf-testimonial-content-inner">
		<div class="edgtf-testimonial-text-holder">
            <?php if($show_icon == "yes"){ ?>
            <div class="edgtf-testimonial-icon-inner">
                <?php
                if(!empty($custom_icon)) { ?>
                    <div class="edgtf-custom-image">
                    	<?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
                    </div>
                    <div class="edgtf-custom-image">
                    	<?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
                    </div>
                <?php } else { 
                    echo oxides_edge_execute_shortcode('edgtf_icon', $icon_parameters);
                    echo oxides_edge_execute_shortcode('edgtf_icon', $icon_parameters);
                } 
                ?>
            </div>
            <?php } ?>
			<div class="edgtf-testimonial-text-inner">
				<?php if($show_title == "yes"){ ?>
                   <<?php echo esc_attr($title_tag); ?> class='edgtf-testimonial-title'>
                        <?php echo esc_attr($title) ?>
                   </<?php echo esc_attr($title_tag); ?>>
				<?php }?>
				<p class="edgtf-testimonial-text"><?php echo trim($text) ?></p>
				<?php if ($show_author == "yes") { ?>
					<div class = "edgtf-testimonial-author">
						<p class="edgtf-testimonial-author-text"><?php echo esc_attr($author)?>
							<?php if($show_position == "yes" && $job !== ''){ ?>
								<span class="edgtf-testimonials-job"> - <?php echo esc_attr($job)?></span>
							<?php }?>
						</p>	
					</div>
				<?php } ?>				
			</div>
		</div>
	</div>	
</div>

<li class="edgtf-blog-list-item clearfix">
	<div class="edgtf-blog-list-item-inner">
		<div class="edgtf-item-image">
			<a href="<?php echo esc_url(get_permalink()); ?>">
				<?php
					 echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
				?>				
			</a>
		</div>
		<div class="edgtf-item-text-holder">
			<<?php echo esc_html($title_tag)?> class="edgtf-item-title">
				<a href="<?php echo esc_url(get_permalink()) ?>" >
					<?php echo esc_attr(get_the_title()) ?>
				</a>
			</<?php echo esc_html($title_tag) ?>>
			
			
			<?php if($post_info_section === 'yes') { ?>
				<div class="edgtf-item-info-section">
					<?php oxides_edge_post_info(array(
						'date' => 'yes',
						'category' => $post_info_category,
						'comments' => $post_info_comments
					)) ?>
				</div>
			<?php } ?>
			
			<?php if ($text_length != '0') {
				$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
				<p class="edgtf-excerpt"><?php echo esc_html($excerpt)?></p>
			<?php } ?>

			<div class="edgtf-read-more-holder">
				<a class="edgtf-read-more-button" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html_e('READ MORE', 'oxides'); ?><span class="arrow_right"></span></a>
			</div>
		</div>
	</div>	
</li>
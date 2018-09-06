
<article class="edgtf-portfolio-item mix <?php echo esc_attr($categories)?>" >
	<div class = "edgtf-item-image-holder">
	<?php
		echo get_the_post_thumbnail(get_the_ID(),$thumb_size);
	?>				
	</div>
	<div class="edgtf-item-text-overlay">
        <a class ="edgtf-portfolio-link" href="<?php echo $image_link; ?>" data-rel="prettyPhoto['pretty_photo_gallery']">
		<div class="edgtf-item-text-overlay-inner">
			<div class="edgtf-item-text-holder">
                <?php echo $icon_html; ?>
                <?php if($display_title == 'yes'){ ?>
                    <<?php echo esc_attr($title_tag)?> class="edgtf-item-title">
                        <span><?php echo esc_attr(get_the_title()); ?></span>
                    </<?php echo esc_attr($title_tag)?>>
                <?php } ?>
				<?php
				echo $separator_html;
                echo $category_html;
                echo $excerpt_html;
				?>
			</div>
		</div>
		</a>
	</div>
</article>

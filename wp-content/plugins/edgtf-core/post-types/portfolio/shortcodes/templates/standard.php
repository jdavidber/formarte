
<article class="edgtf-portfolio-item mix <?php echo esc_attr($categories)?>">
	<div class = "edgtf-item-image-holder">
        <?php
            echo get_the_post_thumbnail(get_the_ID(),$thumb_size);
        ?>
        <div class="edgtf-item-text-overlay">
            <a class ="edgtf-portfolio-link" href="<?php echo esc_url(get_permalink()) ?>"></a>
            <div class="edgtf-item-text-overlay-inner">
                <div class="edgtf-item-text-holder">
                    <?php
                        echo $icon_html;
                    ?>
                </div>
            </div>
        </div>
	</div>
    <?php if($display_title == 'yes'){ ?>
	<div class="edgtf-item-title-holder">
		<<?php echo esc_attr($title_tag)?> class="edgtf-item-title">
			<a href="<?php echo esc_url(get_permalink()) ?>">
				<span><?php echo esc_attr(get_the_title()); ?></span>
			</a>	
		</<?php echo esc_attr($title_tag)?>>
        <?php
            echo $separator_html;
            echo $category_html;
            echo $excerpt_html;
        ?>
	</div>
    <?php } ?>
</article>

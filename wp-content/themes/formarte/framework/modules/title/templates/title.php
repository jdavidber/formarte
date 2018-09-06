<?php do_action('oxides_edge_before_page_title'); ?>
<?php if($show_title_area) { ?>

    <div class="edgtf-title <?php echo oxides_edge_title_classes(); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); echo esc_attr($title_border_bottom_color); echo esc_attr($title_border_bottom_width);?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <div class="edgtf-title-image"><?php if($title_background_image_src != ""){ ?><img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;" /> <?php } ?></div>
        <div class="edgtf-title-holder" <?php oxides_edge_inline_style($title_holder_height); ?>>
            <div class="edgtf-container clearfix">
                <div class="edgtf-container-inner">
                    <div class="edgtf-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
                        <div class="edgtf-title-subtitle-holder-inner">
                            <?php if(!$title_hidden){ ?>
                            <h1 <?php oxides_edge_inline_style($title_color); ?>><span><?php oxides_edge_title_text(); ?></span></h1>
                            <?php } ?>
                            <?php if($has_subtitle){ ?>
                                <span class="edgtf-subtitle" <?php oxides_edge_inline_style($subtitle_color); ?>><span><?php oxides_edge_subtitle_text(); ?></span></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<?php do_action('oxides_edge_after_page_title'); ?>
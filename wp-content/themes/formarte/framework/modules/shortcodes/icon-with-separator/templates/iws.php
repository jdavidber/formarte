<div class="edgtf-iws <?php echo esc_attr($holder_classes); ?>" <?php echo oxides_edge_get_inline_attrs($holder_data); ?>>
    <?php if(!empty($link)) : ?>
        <a class="edgtf-iws-link" href="<?php echo esc_attr($link); ?>" <?php oxides_edge_inline_attr($target, 'target'); ?>>
    <?php endif; ?>
        <div class="edgtf-iws-icon-holder" <?php oxides_edge_inline_style($icon_styles); ?>>
            <?php if(!empty($custom_icon)) : ?>
                <?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
            <?php else: ?>
                <?php echo oxides_edge_execute_shortcode('edgtf_icon', $icon_parameters); ?>
            <?php endif; ?>
        </div>
        <div class="edgtf-iws-content-holder">
            <div class="edgtf-iws-title-holder">
                <<?php echo esc_attr($title_tag); ?> <?php oxides_edge_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
            </div>
            <?php if($params['animate'] == 'yes') { ?>
                <div class="edgtf-lines-separator-holder">
                <span class="edgtf-line" <?php oxides_edge_inline_style($lines_params); ?> ></span>
            <?php } ?>
            <?php echo oxides_edge_execute_shortcode('edgtf_separator', $separator_params); ?>
            <?php if($params['animate'] == 'yes') { ?>
                </div>
            <?php } ?>
            <?php if($text != ''){ ?>
                <p <?php oxides_edge_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
            <?php } ?>
        </div>
    <?php if(!empty($link)) : ?>
        </a>
    <?php endif; ?>
</div>
<div class="edgtf-cwiat-single">
    <div class="edgtf-cwiat-image-holder">
        <img src="<?php echo esc_url($image['url'])?>" alt="<?php echo esc_attr($image['title']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>" />
    </div>
    <div class="edgtf-cwiat-content-holder">
        <div class="edgtf-cwiat-title-holder">
            <<?php echo esc_attr($title_tag); ?> <?php oxides_edge_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
        </div>
        <div class="edgtf-cwiat-text-holder">
            <p <?php oxides_edge_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
            <?php if(!empty($link) && !empty($link_text)) : ?>
                <a class="edgtf-cwiat-link" href="<?php echo esc_attr($link); ?>" <?php oxides_edge_inline_attr($target, 'target'); ?>><?php echo esc_html($link_text); ?></><span class="arrow_right" aria-hidden="true"></span></a>
            <?php endif; ?>
        </div>
    </div>

</div>
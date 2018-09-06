<?php do_action('oxides_edge_before_site_logo'); ?>

<div class="edgtf-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php oxides_edge_inline_style($logo_styles); ?>>
        <img class="edgtf-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="logo"/>
        <?php if(!empty($logo_image_dark)){ ?><img class="edgtf-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="dark logo"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img class="edgtf-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="light logo"/><?php } ?>
    </a>
</div>

<?php do_action('oxides_edge_after_site_logo'); ?>
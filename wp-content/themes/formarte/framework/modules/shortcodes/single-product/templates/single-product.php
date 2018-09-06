<?php if(isset($product_params['sku'])){ ?>
<div class="edgtf-single-product">
    <a href="<?php echo esc_url($product_params['link']); ?>" class="edgtf-sp-link"></a>
    <?php
    if ($product_params['on_sale']) { ?>
        <span class="edgtf-onsale"><span class="edgtf-onsale-inner"> <?php echo esc_html__('%', 'oxides'); ?></span></span>
    <?php } ?>
    <div class="edgtf-sp-image-holder">
        <?php echo wp_kses($product_params['image'], array(
            'img' => array(
                'src' => true,
                'width' => true,
                'height' => true,
                'alt' => true)
        )); ?>
    </div>
    <div class="edgtf-sp-info-holder">
        <<?php echo esc_attr($title_tag); ?> class="edgtf-sp-title" <?php echo oxides_edge_inline_style($title_styles) ?>><?php echo esc_attr($product_params['title']); ?></<?php echo esc_attr($title_tag); ?>>
        <?php
        if($product_params['excerpt'] !== ''){ ?>
            <div class="edgtf-sp-excerpt">
                <?php echo esc_attr($product_params['excerpt']); ?>
            </div>
        <?php }
        if($product_params['rating_exists'] == 'yes') {
            echo wp_kses($product_params['rating'], array(
                'div' => array(
                    'class' => true,
                    'title' => true,
                    'style' => true,
                    'id' => true
                ),
                'span' => array(
                    'style' => true,
                    'class' => true,
                    'id' => true,
                    'title' => true
                ),
                'strong' => array(
                    'class' => true,
                    'id' => true,
                    'style' => true,
                    'title' => true
                )
            ));
        }
        else{ ?>
            <div class="star-rating" style = "display: none" ><span style = "width: 0%" ></span></div>
        <?php } ?>
        <div class="edgtf-sp-price">
            <?php echo wp_kses($product_params['price'], array(
                'del' => array(
                    'class' => true,
                ),
                'span' => array(
                    'class' => true,
                ),
                'ins' => array(
                    'class' => true,
                )
            ));
            ?>
        </div>
    </div>
    <div class="edgtf-sp-button-holder">
        <?php
        if ($product_params['is_in_stock']) { ?>
            <?php
            echo sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s"
                                class="button add-to-cart-button add_to_cart_button product_type_%s">%s</a>',
            esc_url( $product_params['add_to_cart_url'] ),
            esc_attr( $product_params['id'] ),
            esc_attr( $product_params['sku'] ),
            esc_attr( $product_params['quantity'] ),
            esc_attr( $product_params['type'] ),
            esc_html( $product_params['add_to_cart_text'])
            );
        } ?>
    </div>
</div>
<?php } ?>
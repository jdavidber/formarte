<?php
/**
 * Blockquote shortcode template
 */
?>

<blockquote class="edgtf-blockquote-shortcode <?php echo esc_attr($blockquote_classes) ?>" <?php oxides_edge_inline_style($blockquote_style); ?> >
    <?php
    if($blockquote_classes == 'with-icon') {
    ?>
        <span class="edgtf-icon-quotations-holder">
            <?php echo oxides_edge_icon_collections()->getQuoteIcon("font_elegant", true); ?>
        </span>
    <?php } ?>

	<<?php echo esc_attr($blockquote_title_tag); ?> class="edgtf-blockquote-text">
	<span><?php echo esc_attr($text); ?></span>
	</<?php echo esc_attr($blockquote_title_tag);?>>
</blockquote>
<?php
$icon_html = oxides_edge_icon_collections()->renderIcon($icon, $icon_pack, $params);
?>
<div class="edgtf-icon-list-item">
	<div class="edgtf-icon-list-icon-holder <?php echo esc_attr($icon_separator_classes); ?> clearfix">
		<?php print $icon_html;	?>
	</div>
	<p class="edgtf-icon-list-text" <?php echo oxides_edge_get_inline_style($title_style)?> > <?php echo esc_attr($title)?></p>
</div>
<?php
/**
 * Video Button shortcode template
 */
?>

<div class="edgtf-video-button">
	<a class="edgtf-video-button-play" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto" <?php echo oxides_edge_inline_style($button_style);?>>
		<span class="edgtf-video-button-wrapper">
			<span class="arrow_triangle-right"></span>
		</span>
	</a>
	<?php if ($title !== ''){?>
		<<?php echo esc_attr($title_tag);?> class="edgtf-video-button-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_attr($title_tag);?>>
	<?php } ?>
</div>
<?php
$fake_image_src = get_template_directory_uri() . "/assets/img/fake_image_portrait.png";
if($image_proportion === 'landscape'){
	$fake_image_src = get_template_directory_uri() . "/assets/img/fake_image.png";
}
?>
<div class="edgtf-scrolling-image-holder">
	<img class="edgtf-scrolling-fake-image" src="<?php echo esc_url($fake_image_src); ?>" />
	<?php foreach ($images as $image) { ?>
		<div class="edgtf-scrolling-image-img">
			<?php if(isset($custom_link) && $custom_link !== '') { ?>
				<a href="<?php echo esc_url($custom_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>">
			<?php } ?>
				<img src="<?php echo esc_url($image['url'])?>" alt="<?php echo esc_attr($image['title']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>">
			<?php if(isset($custom_link) && $custom_link !== '') { ?>
				</a>
			<?php } ?>
		</div>
	<?php } ?>
</div>
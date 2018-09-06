<?php $image_gallery_val = get_post_meta( get_the_ID(), 'edgtf_post_gallery_images_meta' , true );?>
<?php
	$month = 'M';
	$day = 'd';
	$year = 'Y';
?>
<?php if($image_gallery_val !== ""){ ?>
	<div class="edgtf-post-image">
		<div class="edgtf-blog-gallery edgtf-owl-slider">
			<?php
			if($image_gallery_val != '' ) {
				$image_gallery_array = explode(',',$image_gallery_val);
			}
			if(isset($image_gallery_array) && count($image_gallery_array)!= 0):
				foreach($image_gallery_array as $gimg_id): ?>
					<a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $gimg_id, 'full' ); ?></a>
				<?php endforeach;
			endif;
			?>
		</div>
		<span class="edgtf-post-date-holder">
			<span class="edgtf-post-month-day">
				<span class="edgtf-post-month"><?php the_time($month); ?></span>
				<span class="edgtf-post-day"><?php the_time($day); ?></span>
			</span>	
			<span class="edgtf-post-year"><?php the_time($year); ?></span>
		</span>
	</div>
<?php } ?>
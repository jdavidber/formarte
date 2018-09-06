<?php
	if(isset($title_tag)){
		$title_tag = $title_tag;
	}else{
		$title_tag = 'h2';
	}
?>
<<?php echo esc_attr($title_tag);?> class="edgtf-post-title">
	<span><?php the_title(); ?></span>
</<?php echo esc_attr($title_tag);?>>
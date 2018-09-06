<?php 
	$featured_image = '';
	if ( has_post_thumbnail() ) {
		$thumb_id = get_post_thumbnail_id();
		$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
		$featured_image = "background-image: url('".$thumb_url[0]."');";
	} 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content" <?php oxides_edge_inline_style($featured_image); ?>>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<div class="edgtf-post-mark">
					<span class="icon_link"></span>
				</div>
				<div class="edgtf-post-title">
					<h3 class="edgtf-link-text"><span><?php the_title(); ?></span></h3>
				</div>
			</div>
		</div>
		<a class="edgtf-post-link-link" href="<?php echo esc_html(get_post_meta(get_the_ID(), "edgtf_post_link_link_meta", true)); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
</article>
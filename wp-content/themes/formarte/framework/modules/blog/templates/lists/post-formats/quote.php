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
					<span class="icon_quotations"></span>
				</div>
				<div class="edgtf-post-title">
					<p class="edgtf-quote-text"><?php echo esc_html(get_post_meta(get_the_ID(), "edgtf_post_quote_text_meta", true)); ?></p>

					<span class="edgtf-quote-author"><?php the_title(); ?></span>
				</div>
			</div>
		</div>
		<a class="edgtf-quote-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
</article>
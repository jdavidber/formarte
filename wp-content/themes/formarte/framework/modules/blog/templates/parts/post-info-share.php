<?php if(oxides_edge_options()->getOptionValue('enable_social_share_on_post') == 'yes') : ?>
	<div class="edgtf-blog-share">
		<span class="edgtf-blog-share-text"><?php esc_html_e('Keep connected','oxides'); ?></span>
		<?php echo oxides_edge_get_social_share_html(); ?>
	</div>
<?php endif; ?>
<?php if(oxides_edge_options()->getOptionValue('blog_single_tags') == 'yes'){ ?>
	<div class="edgtf-single-tags-holder">
		<h6 class="edgtf-single-tags-title"><?php esc_html_e('POST TAGS:', 'oxides'); ?></h6>
		<div class="edgtf-tags">
			<?php the_tags('', '', ''); ?>
		</div>
	</div>
<?php } ?>	
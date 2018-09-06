<div class="edgtf-portfolio-gallery">
	<?php
	$media = oxides_edge_get_portfolio_single_media();

	if(is_array($media) && count($media)) : ?>
		<div class="edgtf-portfolio-media">
			<?php foreach($media as $single_media) : ?>
				<div class="edgtf-portfolio-single-media">
					<?php oxides_edge_portfolio_get_media_html($single_media); ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>

<div class="edgtf-two-columns-75-25 clearfix">
	<div class="edgtf-column1">
		<div class="edgtf-column-inner">
			<?php oxides_edge_portfolio_get_info_part('content'); ?>
		</div>
	</div>
	<div class="edgtf-column2">
		<div class="edgtf-column-inner">
			<div class="edgtf-portfolio-info-holder">
				<?php
				//get portfolio custom fields section
				oxides_edge_portfolio_get_info_part('custom-fields');

				//get portfolio date section
				oxides_edge_portfolio_get_info_part('date');

				//get portfolio categories section
				oxides_edge_portfolio_get_info_part('categories');

				//get portfolio tags section
				oxides_edge_portfolio_get_info_part('tags');

				//get portfolio share section
				oxides_edge_portfolio_get_info_part('social');
				?>
			</div>
		</div>
	</div>
</div>
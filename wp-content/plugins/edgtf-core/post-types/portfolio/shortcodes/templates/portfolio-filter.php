<div class = "edgtf-portfolio-filter-holder <?php echo esc_attr($masonry_filter)?>">
	<div class = "edgtf-portfolio-filter-holder-inner">
        <?php if($filter_title != ''){ ?>
            <div class = "edgtf-portfolio-filter-holder-title"><h3><?php echo esc_attr($filter_title); ?></h3></div>
        <?php } ?>
		<?php 
		$rand_number = rand();
		if(is_array($filter_categories) && count($filter_categories)){ ?>
		<ul>
			<?php if($type == 'masonry' || $type == 'pinterest'){ ?>
				<li class="filter" data-filter="*"><span><?php  print esc_html__('All', 'edgt_core')?></span></li>
			<?php } else{ ?>
				<li data-class="filter_<?php print $rand_number ?>" class="filter_<?php print $rand_number ?>" data-filter="all">
                    <span class="edgtf-portfolio-filter-counter"></span>
                    <span class="edgtf-portfolio-filter-name"><?php  print esc_html__('All', 'edgt_core')?></span>

                </li>
			<?php } ?>
			<?php foreach($filter_categories as $cat){				
				if($type == 'masonry' || $type == 'pinterest'){?>
					<li data-class="filter" class="filter" data-filter = ".portfolio_category_<?php print $cat->term_id  ?>">
						<span>
							<?php print $cat->name ?>
						</span>
					</li>
				<?php }else{ ?>
					<li data-class="filter_<?php print $rand_number ?>" class="filter_<?php print $rand_number ?> portfolio_category_<?php print $cat->term_id  ?>" data-filter = ".portfolio_category_<?php print $cat->term_id  ?>">
                    <span class="edgtf-portfolio-filter-counter"></span>
					<span class="edgtf-portfolio-filter-name">
						<?php print $cat->name ?>
					</span>
				</li>
			<?php }} ?>
		</ul> 
		<?php }?>
	</div>		
</div>
<?php
	$month = 'M';
	$day = 'd';
	$year = 'Y';
?>
<?php if ( has_post_thumbnail() ) { ?>
	<div class="edgtf-post-image">
		<?php the_post_thumbnail('full'); ?>
		<span class="edgtf-post-date-holder">
			<span class="edgtf-post-month-day">
				<span class="edgtf-post-month"><?php the_time($month); ?></span>
				<span class="edgtf-post-day"><?php the_time($day); ?></span>
			</span>	
			<span class="edgtf-post-year"><?php the_time($year); ?></span>
		</span>
	</div>
<?php } ?>
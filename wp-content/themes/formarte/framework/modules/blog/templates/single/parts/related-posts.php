<div class="edgtf-related-posts-holder">
	<?php if ( $related_posts && $related_posts->have_posts() ) : ?>
		<div class="edgtf-related-posts-title">
			<h5><?php esc_html_e('YOU MIGHT ALSO LIKE', 'oxides' ); ?></h5>
		</div>
		<div class="edgtf-related-posts-inner clearfix">
			<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
				<div class="edgtf-related-post">
					<div class="edgtf-related-post-image">
						<?php if (has_post_thumbnail()) { ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail(); ?>
							</a>	
						<?php }	?>
					</div>
					<div class="edgtf-related-post-title">
						<h6><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
					</div>
					<div class="edgtf-related-post-info">
						<?php oxides_edge_post_info(array('date' => 'yes')); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; 
	wp_reset_postdata();
	?>
</div>
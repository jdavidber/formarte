<?php
/*
Template Name: Blog: Checkered
*/
?>
<?php get_header(); ?>
<?php get_template_part( 'title' ); ?>
<?php get_template_part('slider'); ?>
	<div class="edgtf-full-width">
		<div class="edgtf-full-width-inner clearfix">
			<?php do_action('oxides_edge_after_container_open'); ?>

			<?php oxides_edge_get_blog('checkered'); ?>
			
			<?php do_action('oxides_edge_before_container_close'); ?>
		</div>
	</div>
<?php get_footer(); ?>
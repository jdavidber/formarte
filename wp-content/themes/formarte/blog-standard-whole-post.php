<?php
    /*
    Template Name: Blog: Standard Whole Post
    */
?>
<?php get_header(); ?>
<?php get_template_part( 'title' ); ?>
<?php get_template_part('slider'); ?>
    <div class="edgtf-container">
        <?php do_action('oxides_edge_after_container_open'); ?>
        <div class="edgtf-container-inner">
            <?php oxides_edge_get_blog('standard-whole-post'); ?>
        </div>
        <?php do_action('oxides_edge_before_container_close'); ?>
    </div>
<?php get_footer(); ?>
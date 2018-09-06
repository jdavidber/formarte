<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php oxides_edge_wp_title(); ?>
    <?php
    /**
     * @see oxides_edge_header_meta() - hooked with 10
     * @see edgt_user_scalable - hooked with 10
     */
    ?>
	<?php do_action('oxides_edge_header_meta'); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php oxides_edge_get_side_area(); ?>

<div class="edgtf-wrapper">
    <div class="edgtf-wrapper-inner">
        <?php oxides_edge_get_header(); ?>

        <?php if(oxides_edge_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='edgtf-back-to-top'  href='#'>
                <span class="edgtf-icon-stack">
                    <span class="line-1"></span>
                    <span class="line-2"></span>
                    <span class="line-3"></span>
                </span>
            </a>
        <?php } ?>
        <?php oxides_edge_get_full_screen_menu(); ?>

        <div class="edgtf-content" <?php oxides_edge_content_elem_style_attr(); ?>>
            <div class="edgtf-content-inner">
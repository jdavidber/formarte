<?php
/*
Template Name: Maintenance Page
*/
$sidebar = oxides_edge_sidebar_layout();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <?php oxides_edge_wp_title(); ?>

        <?php
        /**
         * oxides_edge_header_meta hook
         *
         * @see oxides_edge_header_meta() - hooked with 10
         * @see edgt_user_scalable_meta() - hooked with 10
         */
        do_action('oxides_edge_header_meta');
        ?>

        <?php wp_head(); ?>
    </head>

<body id="frmt-error" <?php body_class(); ?>>
<div class="edgtf-wrapper">
	<div class="edgtf-wrapper-inner">

	<div class="edgtf-container">
	<!-- formarte logo -->
	<div class="logo">
		<img src="/wp-content/uploads/2015/11/logo_white.svg">
	</div>
	<?php do_action('oxides_edge_after_container_open'); ?>
		<div class="edgtf-container-inner edgtf-404-page">
			<div class="edgtf-page-not-found">
                <div class="edgtf-before-title"><span class="edgtf-before-title-icon icon-arrows-remove"></span><span class="edgtf-before-title-text">404</span></div>
				<h1><span>
					<?php if(oxides_edge_options()->getOptionValue('404_title')){
						echo esc_html(oxides_edge_options()->getOptionValue('404_title'));
					}
					else{
                        get_template_part( 'title' );
					} ?>
				</span></h1>
				<h4><span>
					<?php if(oxides_edge_options()->getOptionValue('404_text')){
						echo esc_html(oxides_edge_options()->getOptionValue('404_text'));
					}
					else{
						esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'oxides');
					} ?>
                </span></h4>
				<?php
					$params = array();
					if (oxides_edge_options()->getOptionValue('404_back_to_home')){
						$params['text'] = oxides_edge_options()->getOptionValue('404_back_to_home');
					}
					else{
						$params['text'] = "Back to Home Page";
					}
					$params['link'] = esc_url(home_url('/'));
					$params['target'] = '_self';
				echo oxides_edge_execute_shortcode('edgtf_button',$params);?>
			</div>
		</div>
		<?php do_action('oxides_edge_before_container_close'); ?>
	</div>
</div>
</div>
<?php get_footer(); ?>
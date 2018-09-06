<?php
/**
 * The Header for template.
 *
 * Displays all of the <head> section and everything up till content section.
 *
 * @package Nightly
 * @since 1.0
 */
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div data-role="page" data-theme="a">

				<?php 
				
				if ( ! is_page_template( 'page-navi-circles.php' ) && nightly_global('nightly_navigation_style') != 'disabled' ) {
        	  get_sidebar( 'left' );
        }
        
        if ( !is_page_template( 'page-navi-circles.php' ) && is_active_sidebar( 'nightly-right-sidebar' ) ) {
        	 	get_sidebar( 'right' );
        } else {
	          nightly_header_searchform();
        }
        
        if ( nightly_global('nightly_show_header_info_bar') == true ) {
        		nightly_header_info_bar();
        }
        
        if ( !is_page_template( 'page-navi-circles.php' ) ) : ?>
              
	        <div data-role="header" class="main-header" data-tap-toggle="false" data-theme="a"<?php if ( nightly_global('nightly_header_fixed') ) echo ' data-position="fixed"'; ?>>
	        
	        <?php if ( nightly_global('nightly_header_sidebar_left_custom_url') != '' ) { ?>
	        	<a href='<?php echo esc_url( nightly_global('nightly_header_sidebar_left_custom_url') ); ?>' data-role="none" class="a-sidebar"></a>
	        <?php } else { ?>
	        	<a href='#' data-role="none" class="a-sidebar" id="a-sidebar"></a>
	        <?php } ?>
	            
	            
	            <?php if ( nightly_global('nightly_custom_header_logo') == true ) { ?>
		            <div class="header-logo">
			            <img src="<?php echo esc_url ( nightly_global('nightly_header_logo') ); ?>" alt="<?php echo bloginfo( 'name' ); ?>" />
			          </div>
	            <?php } else { ?>
	            	<h1 class="header-title">
	            	<?php if ( nightly_global('nightly_custom_header_title') == true ) {
	            		echo html_entity_decode ( esc_html (  nightly_global('nightly_header_title') ) );
	            	} else {
	            		bloginfo( 'name' );
	            	} ?>
	            	</h1>
	            <?php } ?>
	            
	            <?php if ( is_active_sidebar( 'nightly-right-sidebar' ) ) { ?>
	                <span id="a-right-sidebar"></span>
	            <?php } else { ?>
	            		<a href='#' data-role="none" id="a-search"><span id="header-search-icon" class="fa fa-search"></span></a>
	            <?php } ?>
	        </div> <!-- .header -->
	        
        <?php endif; ?>
        
        <div data-role="content">
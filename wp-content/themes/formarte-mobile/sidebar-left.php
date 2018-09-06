<?php
/**
 * Main sidebar template file.
 *
 * @package WordPress
 * @subpackage Nightly
 * @since 1.0
 */ 
 
?>

<?php if ( nightly_global('nightly_navigation_style') == 'sidebar' ) : ?>

	<div data-role="panel" data-display="<?php echo esc_html ( nightly_global('nightly_sidebar_transition') ); ?>" id="left-sidebar" data-theme="a" >

			<ul data-role="listview" class="nightly-main-navigation">
			<?php wp_nav_menu( array(
		
		    'menu'           =>     'mobile-menu',
		    'theme_location' =>     'nightly-main-navigation',
		    'container'       => false,
		    'items_wrap'      => '<ul data-role="listview">%3$s</ul>'  ) ); ?>
		</ul>
		
		<?php if ( is_active_sidebar( 'nightly-left-sidebar' ) ) : ?>
		    <?php dynamic_sidebar( 'nightly-left-sidebar' ); ?>
		<?php endif; ?>
		
	</div>
<?php endif; ?> 
<?php if ( nightly_global('nightly_navigation_style') == 'dropdown' ) : ?>
		    
	<div data-role="panel" data-display="overlay" id="navi-dropdown" data-position-fixed="true">
	
    <div class="navi-dropdown-header">
        <a href="#" class="navi-icon-close ui-btn-right" id="close-navi-dropdown"></a>
		</div>	
    
    <nav class="navigation">
         <ul>
            	<?php wp_nav_menu( array(
            
                'menu'           =>     'mobile-menu',
                'theme_location' =>     'nightly-main-navigation',
                'container'       => false,
                'items_wrap'      => '<ul data-role="none">%3$s</ul>'  ) ); ?>
         </ul>
     </nav>
     
     <?php if ( is_active_sidebar( 'nightly-dropdown-area' ) ) : ?>
         <?php dynamic_sidebar( 'nightly-dropdown-area' ); ?>
     <?php endif; ?>
     
   </div>
   
<?php endif; ?>  
		              
		                
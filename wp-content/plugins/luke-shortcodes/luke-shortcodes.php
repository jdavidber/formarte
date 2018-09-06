<?php
/**
 * Plugin Name: Luke Shortcodes
 * Description: A simple shortcode generator. Use with theme Nightly.
 * Version: 1.0
 * Author: Lukas Postulka
 * Author URI: http://themeforest.net/user/lukepostulka
 */

function luke_shortcode_register_styles() {
		if( ! wp_style_is( 'owl-style', 'enqueued' ) ) {
			wp_register_style('luke-shortcodes-style', plugin_dir_url( __FILE__ ) . '/src/shortcodes.css', array(), '1.0' );
			wp_enqueue_style('luke-shortcodes-style');
		}
}
add_action('wp_print_styles', 'luke_shortcode_register_styles');

/**
 * SHORTCODES
 * Below are function generating shortcodes for Nightly
 *
 * @version 1.0
 * @since Nightly 1.0
 *
 * @return string HTML-formatted
 */
 
function luke_alert_function( $atts, $content = null ) { // type=[info/warning/error/success]

   extract(shortcode_atts(array(
      'type' => 'info'
   ), $atts));
   
   if ( $type == "info" ) {
   		return "<div class='nightly-alert nightly-alert-info'><i class='fa fa-2x fa-lightbulb-o fa-fw'></i><p>".do_shortcode($content)."</p></div>";
   }
   if ( $type == "warning" ) {
   		return "<div class='nightly-alert nightly-alert-warning'><i class='fa fa-2x fa-warning fa-fw'></i><p>".do_shortcode($content)."</p></div>";
   }
   if ( $type == "error" ) {
   		return "<div class='nightly-alert nightly-alert-error'><i class='fa fa-2x fa-exclamation fa-fw'></i><p>".do_shortcode($content)."</p></div>";
   }
   if ( $type == "success" ) {
   		return "<div class='nightly-alert nightly-alert-success'><i class='fa fa-2x fa-check fa-fw'></i><p>".do_shortcode($content)."</p></div>";
   }

   return -1;
}

/* function luke_device_function( $atts, $content = null ) { // device=[mobile/desktop]
	extract(shortcode_atts(array(
	   'device' => '',
	), $atts)); ?>
	
	<script type="text/javascript">
	    jQuery(document).ready(function($) {
	    		
	    		<?php if( $device == "mobile" ) : ?>
	    		    if( deviceDetect.any() ) {
	    		    	<?php $returnString = do_shortcode($content); ?>
	    		    } else {
	    		    	<?php $returnString = ""; ?>
	    		    }
	    		<?php elseif( $device == "desktop" ) : ?>
	    		    if( !deviceDetect.any() ) {
	    		    	<?php $returnString = do_shortcode($content); ?>
	    		    } else {
	    		    	<?php $returnString = ""; ?>
	    		    }
	    		<?php else :
	    			$returnString = "";
	    		endif;
	    		
	    		return $returnString; ?>
	    });
	</script>
	<?php
} */

function luke_highlight_function( $atts, $content = null ) { // theme=[a/b/c/d]

   extract(shortcode_atts(array(
      'theme' => get_option("data_theme")
   ), $atts));
   
   return '<span class="highlight" data-theme="'.$theme.'">'.do_shortcode($content).'</span>';
}

function luke_tag_function( $atts, $content = null ) { // theme=[a/b/c/d], href=[#]

   extract(shortcode_atts(array(
      'theme' => get_option("data_theme"),
      'href' => '#'
   ), $atts));
   
   return '<a class="ui-tag" data-theme="'.$theme.'" href="'.$href.'">'.do_shortcode($content).'</a>';
}

function luke_button_function( $atts, $content = null ) { // theme=[a/b/c/d], href=[#], icon=[]

   extract(shortcode_atts(array(
      'theme' => get_option("data_theme"),
      'href' => '#',
      'icon' => ''
   ), $atts));

   if ( $icon != '' ) {
   		return '<a href="'.$href.'"><button data-role="none" class="nightly-button" data-theme="'.$theme.'"><i class="fa fa-'.$icon.'"></i>'.do_shortcode($content).'</button></a>';	
   } else {
   		return '<a href="'.$href.'"><button data-role="none" class="nightly-button" data-theme="'.$theme.'">'.do_shortcode($content).'</button></a>';	
   }
   return -1;
}

function luke_text_box_function( $atts, $content = null ) { // theme=[a/b/c/d], title=[], align=[left]

   extract(shortcode_atts(array(
      'theme' => get_option("data_theme"),
      'title' => '', 
      'align' => 'left'
   ), $atts));

   return '<div data-role="none" class="nightly-text-box align-'.$align.'" data-theme="'.$theme.'"><h3 class="nightly-text-box-title">'.$title.'</h3><p>'.do_shortcode($content).'</p></div>';
}

function luke_progress_function( $atts, $content = null ) { // background=[#333], title=[], value=[0]

   extract(shortcode_atts(array(
      'bg' => '#333',
      'title' => '', 
      'value' => '0'
   ), $atts));

	 return '<span class="bar" data-value="'.$value.'" data-title="'.$title.'" data-background="'.$bg.'"></span>';
}

function register_shortcodes(){
   add_shortcode('luke-alert', 'luke_alert_function');
  // add_shortcode('luke-device', 'luke_device_function');
  add_shortcode('luke-highlight', 'luke_highlight_function');
  add_shortcode('luke-tag', 'luke_tag_function');
  add_shortcode('luke-button', 'luke_button_function');
  add_shortcode('luke-text-box', 'luke_text_box_function');
  add_shortcode('luke-progress', 'luke_progress_function');
}

add_action( 'init', 'register_shortcodes');

?>
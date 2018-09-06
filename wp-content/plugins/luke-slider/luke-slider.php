<?php
/*
Plugin Name: Luke Slider
Plugin URI: http://themeforest.net/lukepostulka
Description: Luke Slider is a lightweight plugin that will provide your theme with slider which you can easily customize in your WordPress dashboard. You can provide your slider with title, short description and button with link. If you don't provide any of those in your WP admin dashboard slider will show only images.
Version: 1.0
Author: Lukas Postulka
Author Email: support@lukepostulka.net
License: GPLv2 or later
*/

/************************************************************************************/
/* Declarations and definitions */
/************************************************************************************/
/**
 * Declares vital files and functions
 *
 * @since 1.0
 */

if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
}

/************************************************************************************/
/* Enqueue Scripts and Styles */
/************************************************************************************/
/**
 * Enqueues scripts and styles for front end.
 *
 * @since 1.0
 */
	
function owl_script() {

	if( ! wp_script_is( 'owl-scripts', 'enqueued' ) ) {
	    wp_register_script('owl-scripts', plugin_dir_url( __FILE__ ) . 'src/owl.carousel.min.js', array( 'jquery' ), '1.0' );
	    wp_enqueue_script('owl-scripts');
	}
	
	wp_register_script('home-slider-script', plugin_dir_url( __FILE__ ) . 'src/owl.script.js', array( 'jquery' ), '1.0' );
	wp_enqueue_script('home-slider-script'); 
	   
}
add_action('wp_print_scripts', 'owl_script');

function slider_register_styles() {
		if( ! wp_style_is( 'owl-style', 'enqueued' ) ) {
			wp_register_style('owl-style', plugin_dir_url( __FILE__ ) . 'src/owl.carousel.css', array(), '1.0' );
			wp_enqueue_style('owl-style');
		}
		
		if( ! wp_style_is( 'owl-theme-style', 'enqueued' ) ) {
			wp_register_style('owl-theme-style', plugin_dir_url( __FILE__ ) . 'src/owl.theme.css', array(), '1.0' );
			wp_enqueue_style('owl-theme-style');
		}

}
add_action('wp_print_styles', 'slider_register_styles');


/************************************************************************************/
/* Slider post type */
/************************************************************************************/
/**
 * Adds slider settings into WP admin
 *
 * @since 1.0
 */
 
function register_slides_posttype() {
	$labels = array(
		'name' 				=> _x( 'Luke Slider', 'post type general name','luke' ),
		'singular_name'		=> _x( 'Slide', 'post type singular name','luke' ),
		'add_new' 			=> __( 'Add Slide','luke' ),
		'add_new_item' 		=> __( 'Add Slide','luke' ),
		'edit_item' 		=> __( 'Edit Slide','luke' ),
		'new_item' 			=> __( 'New Slide','luke' ),
		'view_item' 		=> __( 'View','luke'),
		'search_items' 		=> __( 'Search Slides','luke' ),
		'not_found' 		=> __( 'Slide','luke' ),
		'not_found_in_trash'=> __( 'Slide','luke' ),
		'parent_item_colon' => __( 'Slide','luke' ),
		'menu_name'			=> __( 'Luke Slider','luke' )
		);
		
  $post_type_args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Slide','luke'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'publicly_queryable'=> true,
		'can_export'        => true,
		'query_var'			=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> false,
		'hierarchical' 		=> true,
		'rewrite' 			=> array('slug' => 'slides', 'with_front' => false ),
  	'supports'          => array( 'title', 'excerpt', 'thumbnail' ),
		'menu_position' 	=> 27,
		'menu_icon' 		=> plugin_dir_url( __FILE__ ) . '/images/slider-icon.png',
		'taxonomies'		=> array()
  );
		 
	register_post_type('slides', $post_type_args);
	
}

add_action('init', 'register_slides_posttype');
	
/************************************************************************************/
/* Slider meta settings */
/************************************************************************************/
/**
 * Adds meta settings for each slide
 *
 * Handles button text, its URL and if the link should open in a new tab.
 *
 * @since 1.0
 */

$slidelink_2_metabox = array( 
	'id' => 'slidelink',
	'title' => 'Slide button',
	'page' => array('slides'),
	'context' => 'normal',
	'priority' => 'default',
	'fields' => array(
		array(
			'name' 			=> 'Button text',
			'desc' 			=> '',
			'id' 			=> 'luke_slidebuttontext',
			'class' 		=> 'luke_slidebuttontext',
			'type' 			=> 'text',
			'rich_editor' 	=> 0,
			'std'          	=> 'See more',
			'max' 			=> 0
		),	
		array(
			'name' 			=> 'URL',
			'desc' 			=> '',
			'id' 			=> 'luke_slideurl',
			'class' 		=> 'luke_slideurl',
			'type' 			=> 'text',
			'rich_editor' 	=> 0,
			'std'          	=> '',
			'max' 			=> 0
		),
		array(
			'name' 			=> 'Open link in new tab:',
			'desc' 			=> '',
			'id' 			=> 'luke_slidetarget',
			'class' 		=> 'luke_slidetarget',
			'type' 			=> 'checkbox'
		),
	)
);	
				
function luke_add_slidelink_2_meta_box() {
	global $slidelink_2_metabox;	
		
	foreach( $slidelink_2_metabox['page'] as $page ) {
		add_meta_box($slidelink_2_metabox['id'], $slidelink_2_metabox['title'], 'luke_show_slidelink_2_box', $page, 'normal', 'default', $slidelink_2_metabox);
	}
}
add_action('admin_menu', 'luke_add_slidelink_2_meta_box');

function luke_show_slidelink_2_box()	{
	global $post;
	global $slidelink_2_metabox;
	global $luke_prefix;
	global $wp_version; ?>
	
	<input type="hidden" name="luke_slidelink_2_meta_box_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
	<table class="form-table">
	<?php foreach ($slidelink_2_metabox['fields'] as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true); ?>
		<tr>
				<th style="width:20%"><label for="<?php echo $field['id'] ?>"><?php echo stripslashes($field['name']) ?></label></th>
				<td class="luke_field_type_<?php echo str_replace(' ', '_', $field['type']) ?>">
		<?php switch ($field['type']) {
			case 'text': ?>
				<input type="text" name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>" value="<?php  if($meta) echo $meta; else echo $field['std']; ?>" size="30" style="width:97%" /><br/> <?php echo stripslashes($field['desc']); ?>
				<?php break;
			case 'checkbox': ?>
				<input type="checkbox" name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>"<?php if($meta) echo ' checked="checked"'?> />
				<?php break;
		} ?>
			<td>
	  </tr>
	<?php } ?>
	</table>
<?php }	

function luke_targetlink() {
	$meta = get_post_meta( get_the_ID(), 'luke_slidetarget', true );
	if ($meta == '') {
	    echo '_self';
	} else {
	    echo '_blank';
	  }
}

if ( 'post_type' == 'slider' && post_status == 'publish' ) {
	$attachments = get_posts(array(
	    'post_type' => 'attachment',
	    'posts_per_page' => -1,
	    'post_parent' => $post->ID,
	    'exclude'     => get_post_thumbnail_id()
	));
	if ($attachments) {
	    foreach ($attachments as $attachment) {
	    $thumbimg = wp_get_attachment_link( $attachment->ID, 'thumbnail-size', true );
	    echo $thumbimg;
	    }
	}
}

function luke_slidelink_2_save($post_id) {
	global $post;
	global $slidelink_2_metabox;
	if ( !isset( $_POST['luke_slidelink_2_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['luke_slidelink_2_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	foreach ($slidelink_2_metabox['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = luke_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = $new;
				} 
				update_post_meta($post_id, $field['id'], $new);
			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}
add_action('save_post', 'luke_slidelink_2_save');

/************************************************************************************/
/* Construct Homepage slider */
/************************************************************************************/
/**
* Prints well formatted HTML slider structure when calling luke_slider() function anywhere in the theme.
*
* @since 1.0
*/

function luke_slider() { 
?>
		<div data-role="none" id="main-home-slider" class="fullwidth owl-carousel disableswipe">
			
			<?php $args = array( 'post_type' => 'slides', 'posts_per_page' => -1 );
				$loop = new WP_Query($args);
				
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
					
					<div class="item">
						<?php the_post_thumbnail('slider', array('class' => 'owl-featured-image')); ?>
						<div class="text">
							<?php if(strlen(get_the_title()) != 0) the_title( '<h1>', '</h1>' ); ?>
							<?php remove_filter( 'the_excerpt', 'wpautop' ); ?>
			   			<h2><?php if(the_excerpt() != "") the_excerpt(); ?></h2>
			   			<?php add_filter( 'the_excerpt', 'wpautop' ); ?>
			   			<?php if ( get_post_meta( get_the_id(), 'luke_slideurl', true) != '' ) : ?>
			   				<a data-ajax="false" href="<?php echo esc_url( get_post_meta( get_the_id(), 'luke_slideurl', true ) ); ?>" target="<?php echo luke_targetlink(); ?>"><button data-role="none" class="nightly-button"><?php echo get_post_meta( get_the_id(), 'luke_slidebuttontext', true); ?></button></a>
			   			<?php endif; ?>
			   		</div>
				  
				  </div><!--.owl-item--> 
        
        <?php endwhile; ?>	
        
  </div><!--#main-home-slider--> 	
<?php
}
add_action( 'wp_enqueue', 'luke_slider' );
?>
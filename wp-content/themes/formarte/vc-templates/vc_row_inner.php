<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$output = $after_output = $inner_start = $inner_end = $after_wrapper_open = $before_wrapper_close = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_inner',
	'vc_row-fluid',
	'edgtf-section',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$wrapper_style = "";

/*** Additional Options ***/

if( ! empty($content_aligment)){
	$css_classes[] = 'edgtf-content-aligment-' . $content_aligment;
}
if( ! empty($row_type) && $row_type == 'parallax'){
	$css_classes[] = 'edgtf-parallax-section-holder';
}
if( ! empty($row_type) && $row_type == 'row' && ! empty($columns_height) && $columns_height == 'yes'){
	$css_classes[] = 'edgtf-row-columns-same-height';
}
if($content_width == 'grid'){
	$css_classes[] =  'edgtf-grid-section';
	$css_inner_classes[] = 'edgtf-section-inner';
	$inner_start .= '<div class="edgtf-section-inner-margin clearfix">';
	$inner_end .= '</div>';
} else{
	$css_inner_classes[] = 'edgtf-full-section-inner';
}

if($row_type == 'row' && $css_animation != ''){
	$inner_start .= '<div class="edgtf-vc-row-animation-inner '. $css_animation .'">';
	if($transition_delay !== ''){
		$inner_start .= '<div style="transition-delay:' . $transition_delay . 'ms;">';
		$inner_end .= '</div>';
	}else{
		$inner_start .= '<div>';
		$inner_end .= '</div>';
	}
	$inner_end .= '</div>';
}

if($row_type == 'expandable') {

	$after_wrapper_open .= '<div class="edgtf-er-holder">';
		$after_wrapper_open .= '<div class="edgtf-er-button-holder">';
			$after_wrapper_open .= '<span class="edgtf-er-button" data-morefacts="'. $more_button_label .'" data-lessfacts="'. $less_button_label . '">';
				$after_wrapper_open .= '<span class="edgtf-er-button-text">'. $more_button_label .'</span>';
				$after_wrapper_open .= '<span class="edgtf-er-button-arrow arrow_down"></span>'; 
			$after_wrapper_open .= '</span>';	
		$after_wrapper_open .= '</div>';

		$after_wrapper_open .= '<div class="edgtf-er-outer">';
			$after_wrapper_open .= '<div class="edgtf-er-inner">';

			$before_wrapper_close .= '</div>';	
		$before_wrapper_close .= '</div>';
	$before_wrapper_close .= '</div>';		
}

if($parallax_speed != ''){
	$wrapper_attributes[] =  'data-edgtf-parallax-speed="'.$parallax_speed.'"';
}
if($parallax_background_image != ''){
	$parallax_image_link =  wp_get_attachment_url($parallax_background_image);
	$wrapper_style .= 'background-image:url('.$parallax_image_link.');';
}
if($section_height != ''){
	$wrapper_style .= 'min-height:'.$section_height.'px;height:auto;';
}

if($full_screen_section_height == 'yes'){
	$css_classes[] =  'edgtf-full-screen-height-parallax';
	$after_wrapper_open .= '<div class="edgtf-parallax-content-outer">';
	$before_wrapper_close .= '</div>';

	if($vertically_align_content_in_middle == 'yes'){
		$css_classes[] = 'edgtf-vertical-middle-align';
	}
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$css_inner_classes = preg_replace( '/\s+/', ' ', implode( ' ', $css_inner_classes ));
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$wrapper_attributes[] = 'style="' . $wrapper_style . '"';
$inner_attributes[] = 'class="' . esc_attr( trim( $css_inner_classes ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $after_wrapper_open;
$output .= '<div ' . implode( ' ', $inner_attributes ) . '>';
$output .= $inner_start;
$output .= wpb_js_remove_wpautop( $content );
$output .= $inner_end;
$output .= '</div>';
$output .= $before_wrapper_close;
$output .= '</div>';
$output .= $after_output;

print $output;


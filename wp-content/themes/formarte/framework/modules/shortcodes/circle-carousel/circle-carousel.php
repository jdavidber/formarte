<?php
namespace EdgeOxidesfModules\Shortcodes\CircleCarousel;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

class CircleCarousel implements ShortcodeInterface{

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edgtf_circle_carousel';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 */
	public function vcMap() {

		vc_map(array(
			'name' => esc_html__('Edge Circle Carousel', 'oxides'),
			'base' => $this->getBase(),
			'category' => 'by EDGE',
			'icon' => 'icon-wpb-circle-carousel extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'			=> 'attach_images',
					'heading'		=> 'Images',
					'param_name'	=> 'images',
					'description'	=> 'Select images from media library'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Image Size',
					'param_name'	=> 'image_size',
					'description'	=> 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size'
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Carousel Height (px)',
					'param_name' => 'slider_height',
					'save_always' => true,
					'description' => 'Default value is 480'
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Carousel Auto Play (ms)',
					'param_name' => 'autoplay',
					'description' => 'The speed in milliseconds to wait before auto-rotating. Positive value for a left to right movement, negative for a right to left. Zero to turn off. Default value is 3000.'
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Carousel Speed (ms)',
					'param_name' => 'speed',
					'description' => 'Time in milliseconds it takes to rotate the carousel. Default value is 800.'
				),
				array(
					'type' => 'textfield',
					'heading' => 'Carousel Separation (px)',
					'param_name' => 'separation',
					'description' => 'The amount if pixels to separate each item from one another. Default value is 425.'
				),
				array(
					'type' => 'textfield',
					'heading' => 'Carousel Flanking Items',
					'param_name' => 'flanking_items',
					'description' => 'The amount of visible images on either side of the center item at any time. Default value is 1.'
				),
				array(
                    'type'        => 'dropdown',
                    'heading'     => 'Enable Carousel Edge Fade',
                    'param_name'  => 'edge_fade_enabled',
                    'value'       => array(
                        'No' => 'false',
                        'Yes' => 'true'
                    ),
                    'save_always'	=> true,
                    'description' => 'When true, items fade off into nothingness when reaching the edge. Otherwise, they will move to a hidden position behind the center item.'
                ),
				array(
					'type' => 'textfield',
					'heading' => 'Carousel Multiplier Size',
					'param_name' => 'size_multiplier',
					'description' => 'How much the items should increase/decrease by as they span out (a value of 0.5 will reduce each items size by half). Default value is 0.7.'
				),
				array(
                    'type'        => 'dropdown',
                    'heading'     => 'Enable Carousel Navigation',
                    'param_name'  => 'navigation',
                    'value'       => array(
                        'Yes' => 'yes',
                        'No' => 'no'
                    ),
                    'save_always' => true,
                    'admin_label' => true
                ),
			)
		));

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'images' => '',
			'image_size' => 'thumbnail',
			'slider_height' => '480',
			'autoplay' => '3000',
			'speed' => '800',
			'separation' => '425',
			'flanking_items' => '1',
			'edge_fade_enabled' => 'false',
			'size_multiplier' => '0.7',
			'navigation' => 'yes'
		);

		$params = shortcode_atts($args, $atts);
		$params['image_size'] = $this->getImageSize($params['image_size']);
		$params['images'] = $this->getGalleryImages($params);
		$params['slider_data'] = $this->getSliderData($params);

		$html = oxides_edge_get_shortcode_module_template_part('templates/circle-carousel-template', 'circle-carousel', '', $params);

		return $html;
	}

	/**
	 * Return all configuration data for slider
	 *
	 * @param $params
	 * @return array
	 */
	private function getSliderData($params) {

		$slider_data = array();

		$slider_data['data-height'] = ($params['slider_height'] !== '') ? $params['slider_height'] : '';
		$slider_data['data-autoplay'] = ($params['autoplay'] !== '') ? $params['autoplay'] : '';
		$slider_data['data-speed'] = ($params['speed'] !== '') ? $params['speed'] : '';
		$slider_data['data-separation'] = ($params['separation'] !== '') ? $params['separation'] : '';
		$slider_data['data-flankingitems'] = ($params['flanking_items'] !== '') ? $params['flanking_items'] : '';
		$slider_data['data-edgefadeenabled'] = ($params['edge_fade_enabled'] !== '') ? $params['edge_fade_enabled'] : '';
		$slider_data['data-sizemultiplier'] = ($params['size_multiplier'] !== '') ? $params['size_multiplier'] : '';
		$slider_data['data-navigation'] = ($params['navigation'] !== '') ? $params['navigation'] : '';

		return $slider_data;
	}

	/**
	 * Return images for gallery
	 *
	 * @param $params
	 * @return array
	 */
	private function getGalleryImages($params) {

		$images = array();

		if ($params['images'] !== '') {

			$size = $params['image_size'];
			$image_ids = explode(',', $params['images']);

			foreach ($image_ids as $id) {

				$img = wp_get_attachment_image_src($id, $size);

				$image['url'] = $img[0];
				$image['width'] = $img[1];
				$image['height'] = $img[2];
				$image['title'] = get_the_title($id);

				$images[] = $image;
			}
		}

		return $images;
	}

	/**
	 * Return image size or custom image size array
	 *
	 * @param $image_size
	 * @return array
	 */
	private function getImageSize($image_size) {

		//Remove whitespaces
		$image_size = trim($image_size);
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if ( !empty($matches[0]) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} elseif ( in_array( $image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full') )) {
			return $image_size;
		} else {
			return 'thumbnail';
		}
	}
}
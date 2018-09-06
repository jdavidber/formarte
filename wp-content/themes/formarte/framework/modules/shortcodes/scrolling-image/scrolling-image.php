<?php
namespace EdgeOxidesfModules\Shortcodes\ScrollingImage;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

class ScrollingImage implements ShortcodeInterface{

	private $base;

	/**
	 * Scrolling Image constructor.
	 */
	public function __construct() {
		$this->base = 'edgtf_scrolling_image';

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
	 * @see edgt_core_get_scrolling_image_array_vc()
	 */
	public function vcMap() {

		vc_map(array(
			'name'                      => esc_html__('Edge Scrolling Image', 'oxides'),
			'base'                      => $this->getBase(),
			'category'                  => 'by EDGE',
			'icon'                      => 'icon-wpb-image-gallery extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'			=> 'attach_image',
					'heading'		=> 'Image',
					'param_name'	=> 'image',
					'description'	=> 'Select image from media library'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Image Size',
					'param_name'	=> 'image_size',
					'description'	=> 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size'
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Image Proportion',
					'param_name' => 'image_proportion',
					'description' => '',
					'value'       => array(
						'Portrait' => 'portrait',
						'Landscape' => 'landscape'
					),
                    'save_always'	=> true
				),
				array(
					'type' => 'textfield',
					'heading' => 'Custom Link',
					'param_name' => 'custom_link',
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Custom Link Target',
					'param_name' => 'custom_link_target',
					'description' => 'Select where to open custom link.',
					'value'       => array(
						'Same Widnow' => '_self',
						'New Window' => '_blank'
					),
                    'save_always'	=> true
				)
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
			'image' => '',
			'image_size' => 'full',
			'image_proportion' => 'portrait',
			'custom_link' => '',
			'custom_link_target' => '_self'
		);

		$params = shortcode_atts($args, $atts);

		$params['image_size'] = $this->getImageSize($params['image_size']);
		$params['images'] = $this->getImage($params);

		if($params['custom_link_target'] === '') {
			$params['custom_link_target'] = '_self';
		}

		$html = oxides_edge_get_shortcode_module_template_part('templates/scrolling-image-template', 'scrolling-image', '', $params);

		return $html;
	}

	/**
	 * Return image
	 *
	 * @param $params
	 * @return array
	 */
	private function getImage($params) {

		$images = array();

		if ($params['image'] !== '') {

			$size = $params['image_size'];
			$image_ids = explode(',', $params['image']);

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
			return 'full';
		}
	}
}
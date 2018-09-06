<?php
namespace EdgeOxidesfModules\Shortcodes\FlyingDeck;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

class FlyingDeck implements ShortcodeInterface{

	private $base;

	/**
	 * Flying Deck constructor.
	 */
	public function __construct() {
		$this->base = 'edgtf_flying_deck';

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
	 * @see edgt_core_get_flying_deck_array_vc()
	 */
	public function vcMap() {

		vc_map(array(
			'name'                      => esc_html__('Edge Flying Deck', 'oxides'),
			'base'                      => $this->getBase(),
			'category'                  => 'by EDGE',
			'icon'                      => 'icon-wpb-flying-deck extended-custom-icon',
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
					'description'	=> 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size'
				),
				array(
					'type' => 'exploded_textarea',
					'heading' => 'Custom Links',
					'param_name' => 'custom_links',
					'description' => 'Enter links for each image (Note: divide links with linebreaks (Enter)).'
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Custom Link Target',
					'param_name' => 'custom_links_target',
					'description' => 'Select where to open custom links.',
					'value'       => array(
						'Same Widnow' => '_self',
						'New Window' => '_blank'
					),
                    'save_always'	=> true
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
			'image_size' => 'full',
			'custom_links' => '',
			'custom_links_target' => '_self'
		);

		$params = shortcode_atts($args, $atts);

		$params['image_size'] = $this->getImageSize($params['image_size']);
		$params['images'] = $this->getImages($params);

		if($params['custom_links'] !== '') {
			$params['custom_links'] = explode(',', $params['custom_links']);
		}

		if($params['custom_links_target'] === '') {
			$params['custom_links_target'] = '_self';
		}

		$html = oxides_edge_get_shortcode_module_template_part('templates/flying-deck-template', 'flying-deck', '', $params);

		return $html;
	}

	/**
	 * Return images
	 *
	 * @param $params
	 * @return array
	 */
	private function getImages($params) {

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
			return 'full';
		}
	}
}
<?php
namespace EdgeOxidesfModules\Shortcodes\CarouselWithImageAndText;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

class CarouselWithImageAndText implements ShortcodeInterface{

	private $base;

	/**
	 * Carousel With Image And Text constructor.
	 */
	public function __construct() {
		$this->base = 'edgtf_carousel_with_image_and_text';
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
			'name'                      => esc_html__('Edge Carousel With Image And Text', 'oxides'),
			'base'                      => $this->getBase(),
            'as_parent' => array('only' => 'edgtf_carousel_with_image_and_text_single'),
            'content_element'           => true,
			'category'                  => 'by EDGE',
			'icon'                      => 'icon-wpb-carousel-wiat extended-custom-icon',
            'show_settings_on_create'   => true,
			'params'                    => array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Slide duration',
					'admin_label'	=> true,
					'param_name'	=> 'autoplay',
					'value'			=> array(
						'3'			=> '3',
						'5'			=> '5',
						'10'		=> '10',
						'Disable'	=> 'disable'
					),
					'save_always'	=> true,
					'description' => 'Auto rotate slides each X seconds',
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Slide Animation',
					'admin_label'	=> true,
					'param_name'	=> 'slide_animation',
					'value'			=> array(
						'Slide'		=> 'slide',
						'Fade'		=> 'fade',
						'Fade Up'	=> 'fadeUp',
						'Back Slide'=> 'backSlide',
						'Go Down'	=> 'goDown'
					),
					'save_always'	=> true
				),
                array(
                    'type'			=> 'dropdown',
                    'heading'		=> 'Number of Slides Shown',
                    'param_name' 	=> 'navigation',
                    'value' 		=> array(
                        '3'		=> '3',
                        '4'		=> '4',
                        '5'		=> '5'
                    ),
                    'save_always'	=> true
                ),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Show Navigation Arrows',
					'param_name' 	=> 'navigation',
					'value' 		=> array(
						'No'		=> 'no',
                        'Yes'		=> 'yes'
					),
					'save_always'	=> true
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Show Pagination',
					'param_name' 	=> 'pagination',
					'value' 		=> array(
						'No'		=> 'no',
                        'Yes' 		=> 'yes'
					),
					'save_always'	=> true
				)
			),
            'js_view' => 'VcColumnView'
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
			'autoplay'			=> '5000',
			'slide_animation'	=> 'slide',
			'navigation'		=> 'no',
			'pagination'		=> 'no',
            'number_of_slides'  => '3'
		);

		$params = shortcode_atts($args, $atts);
		$params['slider_data'] = $this->getSliderData($params);
        $params['content'] = $content;

        $html = oxides_edge_get_shortcode_module_template_part('templates/carousel-with-image-and-text', 'carousel-with-image-and-text', '', $params);

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

		$slider_data['data-autoplay'] = ($params['autoplay'] !== '') ? $params['autoplay'] : '';
		$slider_data['data-animation'] = ($params['slide_animation'] !== '') ? $params['slide_animation'] : '';
		$slider_data['data-navigation'] = ($params['navigation'] !== '') ? $params['navigation'] : '';
		$slider_data['data-pagination'] = ($params['pagination'] !== '') ? $params['pagination'] : '';
		$slider_data['data-pagination'] = ($params['number_of_slides'] !== '') ? $params['number_of_slides'] : '';

		return $slider_data;
	}
}
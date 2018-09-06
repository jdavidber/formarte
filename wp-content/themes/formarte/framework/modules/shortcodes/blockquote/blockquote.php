<?php
namespace EdgeOxidesfModules\Blockquote;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Blockquote
 */
class Blockquote implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edgtf_blockquote';

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
	 * @see edgt_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map( array(
				'name' => esc_html__('Edge Blockquote', 'oxides'),
				'base' => $this->getBase(),
				'category' => 'by EDGE',
				'icon' => 'icon-wpb-blockquote extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params' => array(
                    array(
                        "type" => "dropdown",
                        "heading" => "Type",
                        "param_name" => "type",
                        "value" => array(
                            "With Icon" => "with-icon",
                            "With Border"   => "with-border"
                        ),
                        "save_always" => true
                    ),
					array(
						"type" => "textarea",
						"heading" => "Text",
						"param_name" => "text",
						"value" => "Blockquote text",
						"save_always" => true
					),
					array(
						"type" => "dropdown",
						"heading" => "Title tag",
						"param_name" => "title_tag",
						"value" => array(
							""   => "",
							"h2" => "h2",
							"h3" => "h3",
							"h4" => "h4",
							"h5" => "h5",
							"h6" => "h6",
							"Simple Text" => "p",
						),
						"description" => ""
					),
					array(
						"type" => "textfield",
						"heading" => "Width (%)",
						"param_name" => "width"
					)
				)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'type' => 'with-icon',
			'text' => '',
			'title_tag' => 'h4',
			'width' => '',
		);

		$params = shortcode_atts($args, $atts);

		$params['blockquote_classes'] = $this->getBlockquoteClass($params);
		$params['blockquote_style'] = $this->getBlockquoteStyle($params);
		$params['blockquote_title_tag'] = $this->getBlockquoteTitleTag($params,$args);

		//Get HTML from template
		$html = oxides_edge_get_shortcode_module_template_part('templates/blockquote-template', 'blockquote', '', $params);

		return $html;

	}

    /**
     * Return Class for Blockquote
     *
     * @param $params
     * @return string
     */
    private function getBlockquoteClass($params) {
        $blockquote_class = array();

        if ($params['type'] !== '') {
            $blockquote_class[] = $params['type'];
        }

        return implode(';', $blockquote_class);
    }

	/**
	 * Return Style for Blockquote
	 *
	 * @param $params
	 * @return string
	 */
	private function getBlockquoteStyle($params) {
		$blockquote_style = array();

		if ($params['width'] !== '') {
			$width = strstr($params['width'], '%') ? $params['width'] : $params['width'].'%';
			$blockquote_style[] = 'width: '.$width;
		}

		return implode(';', $blockquote_style);
	}

	/**
	 * Return Blockquote Title Tag. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @return string
	 */
	private function getBlockquoteTitleTag($params,$args) {
		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6', 'p');
		return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];
	}
}
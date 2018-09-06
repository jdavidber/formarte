<?php
namespace EdgeOxidesfModules\Counter;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Counter
 */
class Counter implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edgtf_counter';

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
			'name' => esc_html__('Edge Counter', 'oxides'),
			'base' => $this->getBase(),
			'category' => 'by EDGE',
			'admin_enqueue_css' => array(oxides_edge_get_skin_uri().'/assets/css/edgtf-vc-extend.css'),
			'icon' => 'icon-wpb-counter extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array_merge(
				array(
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Counter Type',
						'param_name' => 'counter_type',
						'value' => array(
							'Standard' => 'standard',
							'With Icon' => 'with_icon'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Counter Position',
						'param_name' => 'counter_position',
						'value' => array(
							'Top' => 'top_counter',
							'Left' => 'left_counter'
						),
						'save_always' => true,
						'description' => '',
						'dependency' => array('element' => 'counter_type', 'value' => array('standard'))
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Column One Width (%)',
						'param_name' => 'column_one_proportion',
						'description' => 'This option is only for With Icon Counter Type and for Standard Counter Type with Top Position'
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Column Two Width (%)',
						'param_name' => 'column_two_proportion',
						'description' => 'This option is only for With Icon Counter Type and for Standard Counter Type with Top Position'
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Columns Top/Bottom Padding (px)',
						'param_name' => 'columns_top_bottom_padding',
						'description' => 'This option is only for With Icon Counter Type and for Standard Counter Type with Top Position',
						'group' => 'Design Options'
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Elements Position',
						'param_name' => 'elements_position',
						'value' => array(
							'Left' => 'left',
							'Right' => 'right',
							'Center' => 'center'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Digit',
						'param_name' => 'digit',
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Digit Decimals Value',
						'param_name' => 'decimals_value',
						'value' => array(
							'Default' => '',
							'One' => '1',
							'Two' => '2',
							'Three' => '3',
							'Four' => '4',
							'Five' => '5'
						),
						'description' => '',
						'dependency' => Array('element' => "digit", 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Digit Font Size (px)',
						'param_name' => 'font_size',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => Array('element' => "digit", 'not_empty' => true)
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Digit Font Weight',
						'param_name' => 'font_weight',
						'value' => array(
							'Default' => '',
							'Thin' => '100',
							'Extra-Light' => '200',
							'Light' => '300',
							'Normal' => '400',
							'Medium' => '500',
							'Semi-Bold' => '600',
							'Bold' => '700',
							'Extra-Bold' => '800',
							'Ultra-Bold' => '900'
						),
						'description' => '',
						'group' => 'Design Options',
						'dependency' => Array('element' => "digit", 'not_empty' => true)
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Digit Color',
						'param_name' => 'digit_color',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => Array('element' => "digit", 'not_empty' => true)
					),
				),
				oxides_edge_icon_collections()->getVCParamsArray(array('element' => 'counter_type', 'value' => array('with_icon'))),
				array(
					array(
						'type' => 'textfield',
						'heading' => 'Title',
						'param_name' => 'title',
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Title Tag',
						'param_name' => 'title_tag',
						'value' => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'description' => '',
						'dependency' => Array('element' => "title", 'not_empty' => true)
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Title Color',
						'param_name' => 'title_color',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => Array('element' => "title", 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Text',
						'param_name' => 'text',
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Text Color',
						'param_name' => 'text_color',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => Array('element' => "text", 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Separator Width (%)',
						'param_name' => 'separator_width',
						'admin_label' => true,
						'description' => '',
						'group' => 'Design Options',
						'dependency' => array('element' => 'counter_position', 'value' => array('top_counter'))
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Separator Color',
						'param_name' => 'separator_color',
						'description' => '',
						'group' => 'Design Options'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Separator Top Margin (px)',
						'param_name' => 'separator_top_margin',
						'admin_label' => true,
						'description' => '',
						'group' => 'Design Options',
						'dependency' => array('element' => 'counter_position', 'value' => array('top_counter'))
					),
					array(
						'type' => 'textfield',
						'heading' => 'Separator Left/Right Padding (px)',
						'param_name' => 'separator_padding',
						'admin_label' => true,
						'description' => 'This option is only for With Icon Counter Type and for Standard Counter Type with Top Position',
						'group' => 'Design Options'
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Icon Color',
						'param_name' => 'icon_color',
						'description' => '',
						'group' => 'Design Options',
						'dependency' => array('element' => 'counter_type', 'value' => array('with_icon'))
					),
					array(
						'type' => 'textfield',
						'heading' => 'Icon Size (px)',
						'param_name' => 'icon_size',
						'admin_label' => true,
						'description' => '',
						'group' => 'Design Options',
						'dependency' => array('element' => 'counter_type', 'value' => array('with_icon'))
					)
				)
			)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$default_atts = array(
			'counter_type' => '',
			'counter_position' => '',
			'column_one_proportion' => '30',
			'column_two_proportion' => '70',
			'columns_top_bottom_padding' => '',
			'separator_padding' => '',
			'elements_position' => '',
			'digit' => '',
			'font_size' => '',
			'font_weight' => '',
			'digit_color' => '',
			'decimals_value' => '',
			'title' => '',
			'title_tag' => 'h6',
			'title_color' => '',
			'text' => '',
			'text_color' => '',
			'separator_width' => '',
			'separator_color' => '',
			'separator_top_margin' => '',
			'separator_padding' => '',
			'icon_color' => '',
			'icon_size' => '60'
		);

		$default_atts = array_merge($default_atts, oxides_edge_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

		$iconPackName   = oxides_edge_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
        $params['icon'] = $iconPackName ? $params[$iconPackName] : '';

		//get correct heading value. If provided heading isn't valid get the default one
		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
		$params['title_tag'] = (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];

		$params['counter_styles'] = $this->getCounterStyle($params);
		$params['separator_styles'] = $this->getSeparatorStyle($params);
		$params['title_styles'] = $this->getTitleStyle($params);
		$params['text_styles'] = $this->getTextStyle($params);
		$params['column_one_proportion_styles'] = $this->getColumnOneProportionStyle($params);
		$params['column_two_proportion_styles'] = $this->getColumnTwoProportionStyle($params);
		$params['icon_params'] = $this->generateIconParams($params);

		//Get HTML from template
		$html = oxides_edge_get_shortcode_module_template_part('templates/counter-template', 'counter', '', $params);

		return $html;
	}

	/**
	 * Return Counter Separator styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getSeparatorStyle($params) {
		$separatorStyle = array();

		if ($params['separator_width'] !== '') {
			$separatorStyle[] = 'width: ' . $params['separator_width'] . '%';
		}

		if ($params['separator_color'] !== '') {
			$separatorStyle[] = 'background-color: ' . $params['separator_color'];
		}

		if ($params['separator_top_margin'] !== '') {
			$separatorStyle[] = 'margin-top: ' . oxides_edge_filter_px($params['separator_top_margin']) . 'px';
		}

		return implode(';', $separatorStyle);
	}

	/**
	 * Return Counter Title styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getTitleStyle($params) {
		$titleStyle = array();

		if ($params['title_color'] !== '') {
			$titleStyle[] = 'color: ' . $params['title_color'];
		}

		return implode(';', $titleStyle);
	}

	/**
	 * Return Counter Text styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getTextStyle($params) {
		$textStyle = array();

		if ($params['text_color'] !== '') {
			$textStyle[] = 'color: ' . $params['text_color'];
		}

		return implode(';', $textStyle);
	}

	/**
	 * Return Counter styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getCounterStyle($params) {
		$counterStyle = array();

		if ($params['font_size'] !== '') {
			$counterStyle[] = 'font-size: ' . oxides_edge_filter_px($params['font_size']) . 'px';
		}

		if ($params['font_weight'] !== '') {
			$counterStyle[] = 'font-weight: ' . $params['font_weight'];
		}

		if ($params['digit_color'] !== '') {
			$counterStyle[] = 'color: ' . $params['digit_color'];
		}

		return implode(';', $counterStyle);
	}

	/**
	 * Return Counter Column One Proportion styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getColumnOneProportionStyle($params) {
		$columnOneProportionStyle = array();

		if ($params['column_one_proportion'] !== '') {
			$columnOneProportionStyle[] = 'width: ' . $params['column_one_proportion'] . '%';
		}

		if ($params['separator_color'] !== '') {
			$columnOneProportionStyle[] = 'border-color: ' . $params['separator_color'];
		}
		
		if ($params['separator_padding'] !== '') {
			$columnOneProportionStyle[] = 'padding-right: ' . oxides_edge_filter_px($params['separator_padding']) . 'px';
		}

		if ($params['columns_top_bottom_padding'] !== '') {
			$columnOneProportionStyle[] = 'padding-top: ' . oxides_edge_filter_px($params['columns_top_bottom_padding']) . 'px';
			$columnOneProportionStyle[] = 'padding-bottom: ' . oxides_edge_filter_px($params['columns_top_bottom_padding']) . 'px';
		}

		return implode(';', $columnOneProportionStyle);
	}

	/**
	 * Return Counter Column Two Proportion styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getColumnTwoProportionStyle($params) {
		$columnTwoProportionStyle = array();

		if ($params['column_two_proportion'] !== '') {
			$columnTwoProportionStyle[] = 'width: ' . $params['column_two_proportion'] . '%';
		}

		if ($params['separator_padding'] !== '') {
			$columnTwoProportionStyle[] = 'padding-left: ' . oxides_edge_filter_px($params['separator_padding']) . 'px';
		}

		if ($params['columns_top_bottom_padding'] !== '') {
			$columnTwoProportionStyle[] = 'padding-top: ' . oxides_edge_filter_px($params['columns_top_bottom_padding']) . 'px';
			$columnTwoProportionStyle[] = 'padding-bottom: ' . oxides_edge_filter_px($params['columns_top_bottom_padding']) . 'px';
		}

		return implode(';', $columnTwoProportionStyle);
	}

	/**
     * Generates icon parameters array
     *
     * @param $params
     *
     * @return array
     */
    private function generateIconParams($params) {
        $iconParams = array('icon_attributes' => array());

        $iconParams['icon_attributes']['style'] = $this->generateIconStyles($params);
        $iconParams['icon_attributes']['class'] = 'edgtf-counter-icon-element';

        return $iconParams;
    }

    /**
     * Generates icon styles array
     *
     * @param $params
     *
     * @return string
     */
    private function generateIconStyles($params) {
        $iconStyles = array();

        if(!empty($params['icon_color'])) {
            $iconStyles[] = 'color: '.$params['icon_color'];
        }

        if(!empty($params['icon_size'])) {
            $iconStyles[] = 'font-size:'.oxides_edge_filter_px($params['icon_size']).'px';
        }

        return implode(';', $iconStyles);
    }
}
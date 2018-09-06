<?php
namespace EdgeOxidesfModules\PieCharts\PieChartBasic;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class PieChartBasic
 */
class PieChartBasic implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edgtf_pie_chart';

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
			'name' => esc_html__('Edge Pie Chart', 'oxides'),
			'base' => $this->getBase(),
			'icon' => 'icon-wpb-pie-chart extended-custom-icon',
			'category' => 'by EDGE',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => 'Type',
					'param_name' => 'type',
					'value' => array(
						'Small'   => 'small_pie',
						'Large' => 'large_pie'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Percentage',
					'param_name' => 'percent',
					'description' => '',
					'admin_label' => true,
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Inactive Pie Bar Color',
					'param_name' => 'inactive_background_color',
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Active Pie Bar Color',
					'param_name' => 'active_background_color',
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type' => 'textfield',
					'heading' => 'Percentage Font Size (px)',
					'param_name' => 'percent_font_size',
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Percentage Color',
					'param_name' => 'percent_color',
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type' => 'textfield',
					'heading' => 'Text Area Top Margin (px)',
					'param_name' => 'text_area_top_margin',
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type' => 'textfield',
					'heading' => 'Title',
					'param_name' => 'title',
					'description' => '',
					'admin_label' => true
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Title Color',
					'param_name' => 'title_color',
					'description' => '',
					'group' => 'Design Options',
					'dependency' => array('element' => "title", 'not_empty' => true)
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
					'dependency' => array('element' => "title", 'not_empty' => true)
				),
				array(
					'type' => 'textfield',
					'heading' => 'Text',
					'param_name' => 'text',
					'description' => '',
					'admin_label' => true
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Text Color',
					'param_name' => 'text_color',
					'description' => '',
					'group' => 'Design Options',
					'dependency' => array('element' => "text", 'not_empty' => true)
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Enable Separator',
					'param_name' => 'separator',
					'value' => array(
						'No' => 'no',
						'Yes' => 'yes'
					),
					'admin_label' => true,
					'save_always' => true,
					'description' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => 'Separator Width (%)',
					'param_name' => 'separator_width',
					'description' => '',
					'group' => 'Design Options',
					'dependency' => array('element' => 'separator', 'value' => array('yes'))
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Separator Color',
					'param_name' => 'separator_color',
					'description' => '',
					'group' => 'Design Options',
					'dependency' => array('element' => 'separator', 'value' => array('yes'))
				),
				array(
					'type' => 'textfield',
					'heading' => 'Separator Top Margin (px)',
					'param_name' => 'separator_top_margin',
					'description' => '',
					'group' => 'Design Options',
					'dependency' => array('element' => 'separator', 'value' => array('yes'))
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

		$args = array(
			'type' => 'small_pie',
			'percent' => '',
			'inactive_background_color' => '',
            'active_background_color' => '',
			'percent_font_size' => '',
			'percent_color' => '',
			'text_area_top_margin' => '',
			'title' => '',
			'title_color' => '',
			'title_tag' => 'h6',
			'text' => '',
			'text_color' => '',
			'separator' => 'no',
			'separator_width' => '',
			'separator_color' => '',
			'separator_top_margin' => '',
		);

		$params = shortcode_atts($args, $atts);

		$params['pie_chart_classes'] = $this->getPieChartClasses($params);
		$params['title_tag'] = $this->getValidTitleTag($params, $args);
		$params['pie_chart_data'] = $this->getPieChartData($params);
		$params['percent_styles'] = $this->getPercentStyle($params);
		$params['text_area_styles'] = $this->getTextAreaStyle($params);
		$params['title_styles'] = $this->getTitleStyle($params);
		$params['text_styles'] = $this->getTextStyle($params);
		$params['separator_styles'] = $this->getSeparatorStyle($params);

		$html = oxides_edge_get_shortcode_module_template_part('templates/pie-chart-basic', 'piecharts/piechartbasic', '', $params);

		return $html;
	}

	/**
    * Generates css classes for pie chart bar
    *
    * @param $params
    *
    * @return array
    */
	private function getPieChartClasses($params){
		
		$pieChartClassesArray = array();
		
		if($params['type'] !== ''){
			$pieChartClassesArray[] = 'edgtf-'.$params['type'];
		}

		return implode(' ', $pieChartClassesArray);
	}

	/**
	 * Return correct heading value. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @param $args
	 */
	private function getValidTitleTag($params, $args) {

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
		
		return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];
	}

	/**
	 * Return data attributes for Pie Chart
	 *
	 * @param $params
	 * @return array
	 */
	private function getPieChartData($params) {

		$pieChartData = array();

		if( $params['percent'] !== '' ) {
			$pieChartData['data-percent'] = $params['percent'];
		}

		$pieChartData['data-trackcolor'] = "#f8f4f2";
		if ($params['inactive_background_color'] !== '') {
			$pieChartData['data-trackcolor'] = $params['inactive_background_color'];
		}

		$pieChartData['data-barcolor'] = "#fe6261";
		if ($params['active_background_color'] !== '') {
			$pieChartData['data-barcolor'] = $params['active_background_color'];
		}

		$pieChartData['data-linewidth'] = 4;

		if($params['type'] === 'large_pie') {
			$pieChartData['data-size'] = 222;
			$pieChartData['data-linewidth'] = 5;
		}

		return $pieChartData;
	}

	/**
	 * Return Pie Chart Percent styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getPercentStyle($params) {
		$percentStyle = array();

		if ($params['percent_color'] !== '') {
			$percentStyle[] = 'color: ' . $params['percent_color'];
		}

		if ($params['percent_font_size'] !== '') {
			$percentStyle[] = 'font-size: ' . oxides_edge_filter_px($params['percent_font_size']) . 'px';
		}

		return implode(';', $percentStyle);
	}

	/**
	 * Return Pie Chart Percent styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getTextAreaStyle($params) {
		$textAreaStyle = array();

		if ($params['text_area_top_margin'] !== '') {
			$textAreaStyle[] = 'margin-top: ' . oxides_edge_filter_px($params['text_area_top_margin']) . 'px';
		}

		return implode(';', $textAreaStyle);
	}

	/**
	 * Return Pie Chart Title styles
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
	 * Return Pie Chart Text styles
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
	 * Return Pie Chart Separator styles
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
}
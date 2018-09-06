<?php
namespace EdgeOxidesfModules\ProgressBar;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

class ProgressBar implements ShortcodeInterface{
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_progress_bar';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Edge Progress Bar', 'oxides'),
			'base' => $this->base,
			'icon' => 'icon-wpb-progress-bar extended-custom-icon',
			'category' => 'by EDGE',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Title',
					'param_name' => 'title',
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
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
					'description' => ''
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
					'admin_label' => true,
					'heading' => 'Percentage',
					'param_name' => 'percent',
					'description' => ''
				),	
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Percentage Type',
					'param_name' => 'percentage_type',
					'value' => array(
						'Floating'  => 'floating',
						'Static' => 'static'
					),
					'dependency' => Array('element' => 'percent', 'not_empty' => true)
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Progress Bar Number Color',
					'param_name' => 'number_color',
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Inactive Progress Bar Color',
					'param_name' => 'inactive_background_color',
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Active Progress Bar Color',
					'param_name' => 'active_background_color',
					'description' => '',
					'group' => 'Design Options'
				)
			)
		) );

	}

	public function render($atts, $content = null) {
		$args = array(
            'title' => '',
            'title_tag' => 'h6',
            'title_color' => '',
            'percent' => '100',
            'percentage_type' => 'floating',
            'number_color' => '',
            'inactive_background_color' => '',
            'active_background_color' => ''
        );
		$params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        //get correct heading value. If provided heading isn't valid get the default one
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
		
		$params['percentage_classes'] = $this->getPercentageClasses($params);
		$params['title_styles'] = $this->getTitleStyle($params);
		$params['progress_bar_inactive_styles'] = $this->getProgressBarInactiveStyle($params);	
		$params['progress_bar_active_styles'] = $this->getProgressBarActiveStyle($params);
		$params['progress_bar_number_styles'] = $this->getProgressBarNumberStyle($params);
		$params['progress_bar_arrow_styles'] = $this->getProgressBarArrowStyle($params);	

        //init variables
		$html = oxides_edge_get_shortcode_module_template_part('templates/progress-bar-template', 'progress-bar', '', $params);
		
        return $html;
	}

	/**
    * Generates css classes for progress bar
    *
    * @param $params
    *
    * @return array
    */
	private function getPercentageClasses($params){
		
		$percentClassesArray = array();
		
		if(!empty($params['percentage_type']) !=''){
			
			if($params['percentage_type'] == 'floating'){
				
				$percentClassesArray[]= 'edgtf-floating';

			} elseif($params['percentage_type'] == 'static'){
				
				$percentClassesArray[] = 'edgtf-static';
				
			}
		}
		return implode(' ', $percentClassesArray);
	}

	/**
	 * Return Title styles
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
	 * Return Progress Bar Inactive styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getProgressBarInactiveStyle($params) {
		$progressBarInactiveStyle = array();

		if ($params['inactive_background_color'] !== '') {
			$progressBarInactiveStyle[] = 'background-color: ' . $params['inactive_background_color'];
		}

		return implode(';', $progressBarInactiveStyle);
	}

	/**
	 * Return Progress Bar Active styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getProgressBarActiveStyle($params) {
		$progressBarActiveStyle = array();

		if ($params['active_background_color'] !== '') {
			$progressBarActiveStyle[] = 'background-color: ' . $params['active_background_color'];
		}

		return implode(';', $progressBarActiveStyle);
	}

	/**
	 * Return Progress Bar Number styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getProgressBarNumberStyle($params) {
		$progressBarNumberStyle = array();

		if ($params['active_background_color'] !== '' && $params['percentage_type'] == 'floating') {
			$progressBarNumberStyle[] = 'background-color: ' . $params['active_background_color'];
		}

		if ($params['number_color'] !== '') {
			$progressBarNumberStyle[] = 'color: ' . $params['number_color'];
		}

		return implode(';', $progressBarNumberStyle);
	}

	/**
	 * Return Progress Bar Arrow styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getProgressBarArrowStyle($params) {
		$progressBarArrowStyle = array();

		if ($params['active_background_color'] !== '' && $params['percentage_type'] == 'floating') {
			$progressBarArrowStyle[] = 'border-top-color: ' . $params['active_background_color'];
		}

		return implode(';', $progressBarArrowStyle);
	}
}
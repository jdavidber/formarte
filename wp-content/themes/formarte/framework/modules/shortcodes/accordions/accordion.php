<?php
namespace EdgeOxidesfModules\Accordion;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;
/**
	* class Accordions
*/
class Accordion implements ShortcodeInterface{
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'edgtf_accordion';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return	$this->base;
	}

	public function vcMap() {

		vc_map( array(
			'name' =>  esc_html__('Edge Accordion', 'oxides'),
			'base' => $this->base,
			'as_parent' => array('only' => 'edgtf_accordion_tab'),
			'content_element' => true,
			'category' => 'by EDGE',
			'icon' => 'icon-wpb-accordion extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => 'Extra class name',
					'param_name' => 'el_class',
					'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
				array(
					'type' => 'dropdown',
					'class' => '',
					'heading' => 'Style',
					'param_name' => 'style',
					'value' => array(
						'Accordion' => 'accordion',
						'Toggle' => 'toggle'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'class' => '',
					'heading' => 'Navigation Style',
					'param_name' => 'arrow_style',
					'value' => array(
						'Normal' => 'normal',
						'Simple' => 'simple'
					),
					'save_always' => true,
					'description' => ''
				)
			)
		) );
	}
	public function render($atts, $content = null) {
		$default_atts=(array(
			'title' => '',
			'style' => 'accordion',
			'arrow_style' => 'edgtf-normal-style'
		));
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		
 		$acc_class = $this->getAccordionClasses($params);
		$params['acc_class'] = $acc_class;
		$params['content'] = $content;
		
		$output = '';
		
		$output .= oxides_edge_get_shortcode_module_template_part('templates/accordion-holder-template','accordions', '', $params);

		return $output;
	}

	/**
	   * Generates accordion classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getAccordionClasses($params){
		
		$acc_class = array();
		$style = $params['style'];
		switch($style) {
			case 'toggle':
				$acc_class[] = 'edgtf-toggle edgtf-initial';
				break;			
			default:
				$acc_class[] = 'edgtf-accordion edgtf-initial';
		}
		$arrow_style = $params['arrow_style'];
		switch($arrow_style) {
			case 'simple':
				$acc_class[] = 'edgtf-simple-style';
				break;			
			default:
				$acc_class[] = 'edgtf-normal-style';
		}

		return implode(' ', $acc_class);
	}
}
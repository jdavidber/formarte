<?php
namespace EdgeOxidesfModules\IconListItem;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Icon List Item
 */

class IconListItem implements ShortcodeInterface{
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'edgtf_icon_list_item';
		
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
	 */
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Edge Icon List Item', 'oxides'),
			'base' => $this->base,
			'icon' => 'icon-wpb-icon-list-item extended-custom-icon',
			'category' => 'by EDGE',
			'params' => array_merge(
				\EdgeOxidesIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type' => 'textfield',
						'heading' => 'Icon Size (px)',
						'param_name' => 'icon_size',
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Icon Color',
						'param_name' => 'icon_color',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Title',
						'param_name' => 'title',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Title size (px)',
						'param_name' => 'title_size',
						'description' => '',
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Title Color',
						'param_name' => 'title_color',
						'description' => '',
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Enable Separator',
						'param_name' => 'separator',
						'value' => array(
							'No' => 'no',
							'Yes' => 'yes'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Separator Color',
						'param_name' => 'separator_color',
						'description' => '',
						'dependency' => array('element' => 'separator', 'value' => array('yes'))
					)
				)
			)
		) );
	}
	
	public function render($atts, $content = null) {
		$args = array(
            'icon_size' => '',
            'icon_color' => '',
            'title' => '',
            'title_color' => '',
            'title_size' => '',
            'separator' => 'no',
            'separator_color' => ''
        );

        $args = array_merge($args, oxides_edge_icon_collections()->getShortcodeParams());
		
        $params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		$iconPackName = oxides_edge_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$iconClasses = '';
		
		//generate icon holder classes
		$iconClasses .= 'edgtf-icon-list-item-icon ';
		$iconClasses .= $params['icon_pack'];
		
		$params['icon_classes'] = $iconClasses;
		$params['icon'] = $params[$iconPackName];
		$params['icon_attributes']['class'] = 'edgtf-icon-list-element';	
		$params['icon_attributes']['style'] = $this->getIconStyle($params);		
		$params['title_style'] =  $this->getTitleStyle($params);
		$params['icon_separator_classes'] =  $this->getIconSeparatorClasses($params);

		//Get HTML from template
		$html = oxides_edge_get_shortcode_module_template_part('templates/icon-list-item-template', 'icon-list-item', '', $params);
		return $html;
	}
	 
	/**
     * Generates icon styles
     *
     * @param $params
     *
     * @return array
     */
	private function getIconStyle($params){
		$iconStylesArray = array();

		if(!empty($params['icon_color'])) {
			$iconStylesArray[] = 'color:' . $params['icon_color'];
		}

		if (!empty($params['icon_size'])) {
			$iconStylesArray[] = 'font-size:' .oxides_edge_filter_px( $params['icon_size']) . 'px';
		}

		if(!empty($params['separator_color'])) {
			$iconStylesArray[] = 'border-color:' . $params['separator_color'];
		}
		
		return implode(';', $iconStylesArray);
	}
	 
	/**
     * Generates title styles
     *
     * @param $params
     *
     * @return array
     */
	private function getTitleStyle($params){
		$titleStylesArray = array();

		if(!empty($params['title_color'])) {
			$titleStylesArray[] = 'color:' . $params['title_color'];
		}

		if (!empty($params['title_size'])) {
			$titleStylesArray[] = 'font-size:' .oxides_edge_filter_px( $params['title_size']) . 'px';
		}
		
		return implode(';', $titleStylesArray);
	}

	/**
     * Generates css classes for icon separator
     *
     * @param $params
     *
     * @return array
     */
	private function getIconSeparatorClasses($params){
		$iconSeparatorClassesArray = array();
		
		if(!empty($params['separator']) != ''){
			
			if($params['separator'] == 'no'){
				$iconSeparatorClassesArray[] = 'edgtf-no-separator';
			}
		}

		return implode(' ', $iconSeparatorClassesArray);
	}
}
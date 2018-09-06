<?php
namespace EdgeOxidesfModules\PricingTable;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

class PricingTable implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_pricing_table';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Edge Pricing Table', 'oxides'),
			'base' => $this->base,
			'icon' => 'icon-wpb-pricing-table extended-custom-icon',
			'category' => 'by EDGE',
			'allowed_container_element' => 'vc_row',
			'as_child' => array('only' => 'edgtf_pricing_tables'),
			'params' => array(
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Title',
					'param_name' => 'title',
					'value' => 'Basic Plan',
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Enable Title Separator',
					'param_name' => 'title_separator',
					'value' => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Price',
					'param_name' => 'price',
					'description' => 'Default value is 100'
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Currency',
					'param_name' => 'currency',
					'description' => 'Default mark is $'
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Price Period',
					'param_name' => 'price_period',
					'description' => 'Default label is /mo'
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Show Button',
					'param_name' => 'show_button',
					'value' => array(
						'No' => 'no',
						'Yes' => 'yes'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Button Text',
					'param_name' => 'button_text',
					'dependency' => array('element' => 'show_button',  'value' => 'yes') 
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Button Link',
					'param_name' => 'link',
					'dependency' => array('element' => 'show_button',  'value' => 'yes')
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Active',
					'param_name' => 'active',
					'value' => array(
						'No' => 'no',
						'Yes' => 'yes'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Content',
					'param_name' => 'content',
					'value' => '<li>content content content</li><li>content content content</li><li>content content content</li>',
					'description' => ''
				)
			)
		));
	}

	public function render($atts, $content = null) {
	
		$args = array(
			'title'           => 'Basic Plan',
			'title_separator' => 'yes',
			'price'           => '100',
			'currency'        => '$',
			'price_period'    => '/mo',
			'active'          => 'no',
			'show_button'	  => 'no',
			'link'            => '',
			'button_text'     => 'Buy Now'
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html						= '';
		$pricing_table_clasess		= '';
		
		if($active === 'yes') {
			$pricing_table_clasess .= ' edgtf-active';
		}
		
		$params['pricing_table_classes'] = $pricing_table_clasess;
		$params['content']= $content;
		
		$html .= oxides_edge_get_shortcode_module_template_part('templates/pricing-table-template','pricing-table', '', $params);
		return $html;
	}
}
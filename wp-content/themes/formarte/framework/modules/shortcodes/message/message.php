<?php
namespace EdgeOxidesfModules\Message;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Message
 */
class Message implements ShortcodeInterface	{
	private $base; 
	
	function __construct() {
		$this->base = 'edgtf_message';

		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
		* Returns base for shortcode
		* @return string
	 */
	public function getBase() {
		return $this->base;
	}	
	public function vcMap() {
						
		vc_map( array(
			'name' => esc_html__('Edge Message', 'oxides'),
			'base' => $this->base,
			'category' => 'by EDGE',
			'icon' => 'icon-wpb-message extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'colorpicker',
					'heading' => 'Background Color',
					'param_name' => 'background_color',
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Border Color',
					'param_name' => 'border_color',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Border Width (px)',
					'param_name' => 'border_width',
					'description' => 'Default value is 2'
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Close Icon Color',
					'param_name' => 'close_icon_color',
					'description' => '',
				),
				array(
					'type' => 'textarea_html',
					'heading' => 'Content',
					'param_name' => 'content',
					'value' => '<p>'.'I am test text for Message shortcode.'.'</p>',
					'description' => ''
				)
			)
		) );

	}

	public function render($atts, $content = null) {
		
		$args = array(
            'background_color' => '',
            'border_color' => '',
            'border_width' => '',
            'close_icon_color' => ''
        );
		
		$params = shortcode_atts($args, $atts);
		$params['content']= $content;

		//Extract params for use in method
		extract($params);

		$params['message_styles'] = $this->getHolderStyle($params);
		$params['close_icon_styles'] = $this->getCloseIconStyle($params);
		
		$html = oxides_edge_get_shortcode_module_template_part('templates/message-holder-template', 'message', '', $params);
		
		return $html;
	}
	
	/**
     * Generates message close icon styles
     *
     * @param $params
     *
     * @return array
     */
	private function getCloseIconStyle($params){
		$closeIconStyles = array();

        if(!empty($params['close_icon_color'])) {
            $closeIconStyles[] = 'color: '.$params['close_icon_color'];
        }

        return implode(';', $closeIconStyles);
	}

	/**
     * Generates message holder styles
     *
     * @param $params
     *
     * @return array
     */
	private function getHolderStyle($params){
		$holderStyles = array();
		
		if(!empty($params['background_color'])) {
            $holderStyles[] = 'background-color: '.$params['background_color'];
        }

        if(!empty($params['border_color'])) {
            $holderStyles[] = 'border-color:'.$params['border_color'].'';
        }
		if(!empty($params['border_width'])) {
            $holderStyles[] = 'border-width:'.$params['border_width'].'px';
		}

        return implode(';', $holderStyles);
	}
}
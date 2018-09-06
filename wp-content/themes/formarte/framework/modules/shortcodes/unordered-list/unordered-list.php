<?php
namespace EdgeOxidesfModules\UnorderedList;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class unordered List
 */
class UnorderedList implements ShortcodeInterface{

	private $base;

	function __construct() {
		$this->base='edgtf_unordered_list';
		
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**\
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Edge List - Unordered', 'oxides'),
			'base' => $this->base,
			'icon' => 'icon-wpb-unordered-list extended-custom-icon',
			'category' => 'by EDGE',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Style',
					'param_name' => 'style',
					'value' => array(
						'Circle Mark' => 'circle',
						'Ok Square Mark' => 'ok_square'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Enable List Animation',
					'param_name' => 'animate',
					'value' => array(
						'No' => 'no',
						'Yes' => 'yes'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'textarea_html',
					'heading' => 'Content',
					'param_name' => 'content',
					'value' => '<ul><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ul>',
					'description' => ''
				)
			)
		) );
	}


	public function render($atts, $content = null) {
		$args = array(
            'style' => '',
            'animate' => ''
        );
		$params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		
		$list_item_classes = "";

        if ($style != '') {
			if($style == 'circle'){
				$list_item_classes .= ' edgtf-circle';
			} elseif ($style == 'ok_square') {
				$list_item_classes .= ' edgtf-ok-square';
			}          
        }

		if ($animate == 'yes') {
			$list_item_classes .= ' edgtf-animate-list';
		}
		
		$html = '';
		
        $html .= '<div class="edgtf-unordered-list '.$list_item_classes.'">';
		$html .= do_shortcode($content);
		$html .= '</div>';
        return $html;
	}
}